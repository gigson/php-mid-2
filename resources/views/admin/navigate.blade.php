@extends('layouts.app')

@section('content')


<div class="nav-flex-container">
    <a href="{{ route('categories') }}">
        <div class = "nav-flex-item">
            Categories
        </div>
    </a>
    <a href="{{ route('postsForEdit') }}">
        <div class = "nav-flex-item">
            View Posts
        </div>
    </a>
    <a href="{{ route('createPost') }}">
        <div class = "nav-flex-item">
            Add New Post
        </div>
    </a>

</div>




@endsection
