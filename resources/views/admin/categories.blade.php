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
        <h3>Add New Category:</h3>
        <hr>
        <form action="{{route('storeCategory')}}" method="post">
            @csrf
            <label for="name">Name:</label><br>
            <input type="text" name="name"><br>

            <label for="parent-category">Parent Category:</label><br>
            <select name="parent-category">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select><br>

            <input type="submit" value="Add category">
        </form>
    </div>

    <div class="panel">
        <h3>Existing Categories</h3>
        <hr>
        @foreach($categories as $category)
            <div class="panel-item">
                <form action="{{ route('updateCategory') }}" method="post">
                    @csrf
                    <label for="name">Name:</label><br>
                    <input type="text" name="name" value="{{$category->name}}"><br>

                    <label for="parent-category">Parent Category:</label><br>
                    <select name="parent-category">
                        <option></option>
                        @foreach($categories as $categoryInner)
                            @if($categoryInner->id == $category->parent_id)
                                <option selected="selected" value="{{$categoryInner->id}}">{{$categoryInner->name}}</option>
                            @else
                                <option value="{{$categoryInner->id}}">{{$categoryInner->name}}</option>
                            @endif
                        @endforeach
                    </select><br>

                    <input type="text" id="id" name="id" value="{{$category->id}}" hidden>
                    <input type="submit" value="Update">
                </form>
                <form action="{{ route('deleteCategory') }}" method="post">
                    @csrf
                    <input type="text" name="id" value="{{$category->id}}" hidden>
                    <input type="submit" value="Delete">
                </form>
            </div>
        @endforeach
    </div>



@endsection
