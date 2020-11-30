@extends('layouts.app')

@section('content')
    <div>
        @if($errors->any())
            <div>
                <ul style="color: red">
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="panel">
        <h3>Add New Post:</h3>
        <hr>
        <form action="{{route('storePost')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="title">Title:</label><br>
            <input type="text" name="title"><br>

            <label for="body">Body:</label><br>
            <input type="text" name="body"><br>

            <label for="image">Image:</label><br>
            <input type="file" name="image"><br>

            <label for="category">Category:</label><br>
            <select name="category" style="margin-bottom: 5px">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select><br>

            <label for="tags">Tags: </label>
            <button onclick="addTag()" type="button" class="add-tag-btn">Add</button>
            <div>
                <ol id="tags-ol">
                    <li>
                        <input type="text" name="tags[]">
                    </li>
                </ol>
            </div>

            {{--tag--}}
            <input type="submit" value="Add Post">
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
