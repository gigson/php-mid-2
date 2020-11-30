@extends('layouts.app')

@section('content')
    <div class="panel">
        <h3>Posts:</h3>

        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Edit</th>
            </tr>

            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td><a href="{{ route('editPost', ["postId" => $post->id]) }}">Edit</a></td>
                </tr>
            @endforeach

        </table>


    </div>


@endsection
