<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\Input;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with(["tags", "user", "category"])->get();
        $postsHot = [];
        $postsInteresting = [];

        foreach ($posts as $post) {
            foreach ($post->tags as $tag) {
                if ($tag->name == "HOT") {
                    array_push($postsHot, $post);
                }
                if ($tag->name == "INTERESTING") {
                    array_push($postsInteresting, $post);
                }
            }
        }

        return view('public.main', [
            "categories" => Category::get(),
            "posts" => Post::with(["tags", "user", "category"])->orderBy("created_at", "desc")->get(),
            "postsHot" => $postsHot,
            "postsInteresting" => $postsInteresting,
        ]);

    }

    /**
     * Display a listing of the resource by category.
     *
     * @param $categoryId
     */
    public function indexByCategory($categoryId)
    {
        return view('public.list', [
            "categories" => Category::get(),
            "posts" => Post::with(["tags", "user", "category"])->where(["category_id" => $categoryId])->get()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param $postId
     */
    public function show($postId)
    {
        $post = Post::with(["tags", "user", "category"])->where(["id" => $postId])->first();
        return view('public.single', [
            "categories" => Category::get(),
            "post" => $post,
            "posts" => Post::with(["tags", "user", "category"])->where(["category_id" => $post->category_id])->get()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param $postId
     */
    public function search()
    {
        $result = [];
        if (Input::get('search-text')) {
            if (Input::get('search-place') == "body") {
                $result = Post::with(["tags", "user", "category"])->where('body', 'like', '%' . Input::get('search-text') . '%')->get();

            } else {
                $result = Post::with(["tags", "user", "category"])->where('title', 'like', '%' . Input::get('search-text') . '%')->get();
            }
        }

        return view('public.search', [
            "categories" => Category::get(),
            "result" => $result
        ]);
    }


}
