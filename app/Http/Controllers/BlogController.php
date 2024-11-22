<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;


class BlogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view('blog.index',
            [
                'posts' => Blog::query()->with(['user'])
                    ->where('status', '=', true)
                    ->where('published_at', '<=', now())
                    ->paginate(),
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
        $posts = Blog::query()->with(['user'])->where('user_id', $author->id)->where('status', '=', true)->paginate();

        return view('blog.posts-author', [
            'author' => $author,
            'posts' => $posts,
        ]);
    }

    public function authorsList(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('blog.authors', [
            'authors' => User::query()->get(),
        ]);
    }
}
