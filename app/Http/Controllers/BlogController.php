<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;


class BlogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view('blog.index',
            [
                'posts' => Blog::query()->with(['user'])->where('status', '=', true)->paginate(6),
            ]);
    }

    public function show($slug)
    {
        return view('blog.show', [
            'post' => Blog::query()->where('slug', '=', $slug)->firstOrFail(),
        ]);
    }

    public function author($name)
    {
        $author = User::query()->where('name', '=' , $name)->FirstOrFail();
        $posts = Blog::query()->with(['user'])->where('user_id', $author->id)->where('status', '=', true)->paginate(10);

        return view('blog.author', [
            'author' => $author,
            'posts' => $posts,
        ]);
    }

    public function authorsList(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('blog.authors', [
            'authors' => User::query()->get(),
        ]);
    }
}
