<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ახალი ამბები - PrimeTime</title>

    <!-- Fonts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
{{--    <link href="{{ asset('css/pm.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/pm2.css') }}" rel="stylesheet">--}}

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
        <h2>პოპულარური სიახლეები</h2>
        <hr style="border-color: red">
    </div>


    <div class="flex-container">
        @foreach($postsHot as $post)
            @if($loop->index < 10)

                <div class="flex-content">
                    <a href="{{route('single', ["postId"=>$post->id])}}">
                        <img style='height: 100%; width: 100%; object-fit: contain'
                             src="{{asset('images')."/".$post->image}}">
                        <div>
                            {{$post->title}}
                        </div>
                    </a>
                </div>

            @endif
        @endforeach
    </div>

    <div style="margin-left: 30px; margin-right: 50px; margin-top: 50px">
        <h2>ახალ სტატიები</h2>
        <hr style="border-color: red">
    </div>


    <div class="flex-container">
        @foreach($postsHot as $post)
            @if($loop->index < 10)

                <div class="flex-content">
                    <a href="{{route('single', ["postId"=>$post->id])}}">
                        <img style='height: 100%; width: 100%; object-fit: contain'
                             src="{{asset('images')."/".$post->image}}">
                        <div>
                            {{$post->title}}
                        </div>
                    </a>
                </div>

            @endif
        @endforeach
    </div>

    <div style="margin-left: 30px; margin-right: 50px; margin-top: 50px">
        <h2>ეს საინტერესოა</h2>
        <hr style="border-color: red">
    </div>


    <div class="flex-container">
        @foreach($postsInteresting as $post)
            @if($loop->index < 10)

                <div class="flex-content">
                    <a href="{{route('single', ["postId"=>$post->id])}}">
                        <img style='height: 100%; width: 100%; object-fit: contain'
                             src="{{asset('images')."/".$post->image}}">
                        <div>
                            {{$post->title}}
                        </div>
                    </a>
                </div>

            @endif
        @endforeach
    </div>

</div>

</body>
</html>
