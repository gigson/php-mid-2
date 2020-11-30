<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>კატეგორია - PrimeTime</title>

    <!-- Fonts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">


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
            <button type="button"> search</button>
        </div>
    </nav>
</header>

<div style="margin-left: 30px; margin-right: 50px; margin-top: 50px">
    <h2>{{$category->name}}</h2>
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

</body>
</html>
