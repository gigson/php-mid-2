@extends('layouts.app')

@section('content')
    <div class="panel">
        <h3>Edit Post:</h3>
        <hr>
        <form action="{{route('updatePost')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Title:</label><br>
            <input type="text" name="title" value="{{$post->title}}"><br>

            <label for="body">Body:</label><br>
            <input type="text" name="body" value="{{$post->body}}"><br>

            <label for="image">Image:</label><br>
            <img src="{{asset('images')."/".$post->image}}" style="max-height: 200px"><br>
            <input type="file" name="image"><br>

            <label for="category">Category:</label><br>
            <select name="category" style="margin-bottom: 5px">
                <option></option>
                @foreach($categories as $category)
                    @if($category->id == $post->category_id)
                        <option selected="selected" value="{{$category->id}}">{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
            </select><br>

            <label for="tags">Tags: </label>
            <button onclick="addTag()" type="button" class="add-tag-btn">Add</button>
            <div>
                <ol id="tags-ol">
                    @foreach($post->tags as $tag)
                        <li>
                            <input type="text" name="tags[]" value="{{$tag->name}}">
                        </li>
                    @endforeach
                </ol>
            </div>

            <input type="text" name="id" value="{{$post->id}}" hidden><br>
            <input type="submit" value="Save Post">
        </form>
    </div>

    <script>
        function addTag() {
            let ol = document.getElementById("tags-ol");
            let li = document.createElement("li");
            li.innerHTML = '<input type="text" name="tags[]">'
            ol.appendChild(li);
        }
    </script>

@endsection
