<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ახალი ამბები - PrimeTime</title>

    <!-- Fonts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


    <!-- Styles -->
    <style>

    </style>


    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0"
            nonce="YKYloL0Q"></script>
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
            <button type="button"> search</button>
        </div>
    </nav>
</header>

<div class="container">
    <div>
        <div><span>{{$post->category->name}}</span></div>
        <hr>
        <div style="margin-top: 15px; border-left: 4px solid #ec1c24; padding-left: 15px">
            <h2>{{$post->title}}</h2>
        </div>
        <div>
            <img src="{{asset('images')."/".$post->image}}" style="max-height: 500px"><br>
        </div>
        <div>
            <h4>{{$post->body}}</h4>
        </div>

    </div>

    <div style="margin-left: 10px; margin-bottom: 50px; margin-top: 50px">
        <h2>კომენტარები</h2>
        <hr style="border-color: red">
    </div>

    <div>
        <div class="fb-comments" data-href="http://127.0.0.1:8000/mid-2/post/{{$post->id}}" data-numposts="5"
             data-width=""></div>
    </div>

    <div style="margin-left: 10px; margin-bottom: 50px; margin-top: 50px">
        <h2>მსგავსი</h2>
        <hr style="border-color: red">
    </div>

    <div class="flex-container">
        @foreach($posts as $post)
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


<div id="fb-root"></div>
</body>
</html>
