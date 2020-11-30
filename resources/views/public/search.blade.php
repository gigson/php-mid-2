<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ახალი ამბები - PrimeTime</title>

    <!-- Fonts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('css/pm.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/pm2.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Styles -->
    <style>


    </style>
</head>
<body>

<header>
    <nav class="nav-bar">
        <div class="nav-bar-logo">
            <a href="/">
                <img src="{{asset('images')."/pm-logo.png"}}" style="height: 80px; width: 80px">
            </a>
        </div>
        <div class="nav-bar-start">
            @foreach($categories as $category)
                @if($category->parent_id == null)
                    <div class="dropdown-parent">
                        <div>
                            <a href="{{route("category", ["categoryId" => $category->id])}}">{{$category->name}}</a>
                        </div>


                        @foreach($categories as $categoryChild)
                            @if($category->id == $categoryChild->parent_id)
                                <div class="dropdown">
                                    <a href="{{route("category", ["categoryId" => $categoryChild->id])}}">{{$categoryChild->name}}</a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            @endforeach
        </div>
        <div class="nav-bar-end">
            <div>
                <a href="{{route('search')}}">
                    <i class="fa fa-search" style="font-size: 30px; margin-right: 5px"></i>
                </a>
            </div>
        </div>
    </nav>
</header>


<div class="container" style="margin-right: 50px; margin-left: 50px">

    <div style="margin-left: 30px; margin-right: 50px; margin-top: 50px">
        <h2>ძებნა</h2>
        <hr style="border-color: red">
    </div>

    <div class="flex-container">
        <div class="flex-content">
            <form action="">
                @csrf
                <label style="font-size: 1.1em" for="search-text">საძიებო ტექსტი:</label><br>
                <input style="margin-top: 10px" type="text" name="search-text">
                <input style="margin-left: 5px" type="submit" value="ძებნა"><br>

                <div style="margin-top: 5px;">
                    <input type="radio" name="search-place" value="title" checked>
                    <label>სათაური</label>

                    <input type="radio" name="search-place" value="body">
                    <label>ციტატა</label>
                </div>

            </form>
        </div>
    </div>


    @if($result!= null && !$result->isEmpty())
        <div style="margin-left: 30px; margin-right: 50px; margin-top: 50px">
            <h2>შედეგი</h2>
            <hr style="border-color: red">
        </div>

        <div class="flex-container">
            @foreach($result as $post)
                <div class="flex-content">
                    <a href="{{route('single', ["postId"=>$post->id])}}">
                        <img style='height: 100%; width: 100%; object-fit: contain'
                             src="{{asset('images')."/".$post->image}}">
                        <div>
                            {{$post->title}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    @endif


</div>

</body>
</html>
