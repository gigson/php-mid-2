<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.navigate');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function indexPostsForEdit()
    {
        return view('admin.post.view', [
            "categories" => Category::get(),
            "posts" => Post::with(["user", "category"])->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $postId
     */
    public function editPost($postId)
    {
        return view('admin.post.edit', [
            "categories" => Category::get(),
            "post" => Post::with(["tags"])->where(["id" => $postId])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function updatePost(Request $request)
    {
        if (Input::file("image")) {
            $dest = public_path("images");
            $filename = uniqid() . ".jpg";
            Input::file("image")->move($dest, $filename);

            Post::where([
                ["id", $request->input("id")],
            ])->update([
                "image" => $filename,
            ]);
        }

        Post::where([
            ["id", $request->input("id")],
        ])->update([
            "title" => $request->input("title"),
            "body" => $request->input("body"),
            "category_id" => $request->input("category"),
        ]);

        Tag::where([
            ["post_id", $request->input("id")]
        ])->delete();

        foreach ($request->input("tags") as $tag) {
            if ($tag == null) {
                continue;
            }
            Tag::create([
                "post_id" => $request->input("id"),
                "name" => $tag
            ]);
        }

        return view('admin.post.edit', [
            "categories" => Category::get(),
            "post" => Post::with(["tags"])->where(["id" => $request->input("id")])->first()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function createPost()
    {
        return view('admin.post.create', [
            "categories" => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePost(Request $request)
    {
        $this->validate($request, [
            "image" => "required",
        ]);

        if (Input::file("image")) {
            $dest = public_path("images");
            $filename = uniqid() . ".jpg";
            Input::file("image")->move($dest, $filename);
        }

        $post = Post::create([
            "title" => $request->input("title"),
            "body" => $request->input("body"),
            "category_id" => $request->input("category"),
            "image" => $filename,
            "user_id" => Auth::id()
        ]);

        foreach ($request->input("tags") as $tag) {
            if ($tag == null) {
                continue;
            }
            Tag::create([
                "post_id" => $post->id,
                "name" => $tag
            ]);
        }

        return redirect()->route('createPost');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function destroyPost(Request $request)
    {
        Post::where([
            ["id", $request->input("id")],
        ])->delete();

        return view('admin.post.view', [
            "categories" => Category::get(),
            "posts" => Post::with(["user", "category"])->get()
        ]);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexCategories()
    {
        return view('admin.categories', [
            "categories" => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCategory(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
        ]);

        Category::create([
            "name" => $request->input("name"),
            "parent_id" => $request->input("parent-category")
        ]);

        return redirect()->route('categories');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyCategory(Request $request)
    {
        Category::where([
            ["id", $request->input("id")],
        ])->delete();

        return redirect()->route('categories');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCategory(Request $request)
    {
        Category::where([
            ["id", $request->input("id")],
        ])->update([
            "name" => $request->input("name"),
            "parent_id" => $request->input("parent-category")
        ]);

        return redirect()->route('categories');
    }

}
