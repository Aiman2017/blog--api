<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function index()
    {
        if (!Gate::allows('viewAny', Blog::class)) {
            return redirect()->route('blog.index');
        }
        return view('blog.admin.index', [
            'posts' => Blog::query()->with('user')
                ->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('viewAny', Blog::class)) {
            return redirect()->route('blog');
        }
        return view('blog.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request): RedirectResponse
    {
        if (Gate::allows('create', Blog::class)) {
            return redirect()->route('admin.blog.index')->with([
                'error' => 'You don\'t have permission to create  post!',
            ]);
        }
        Blog::query()->create($request->validated() + ['user_id' => auth()->user()->id]);

        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id
    ): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|RedirectResponse {
        if (!Gate::allows('viewAny', Blog::class)) {
            return redirect()->route('blog');
        }
        $post = Blog::query()->with(['user'])->findOrFail($id);
        return view('blog.admin.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Blog::query()->findOrFail($id);

        if (!Gate::allows('viewAny', Blog::class)) {
            return redirect()->route('blog.index');
        }
        return view('blog.admin.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id): RedirectResponse
    {
        $post = Blog::query()->findOrFail($id);

        if (Gate::denies('update', $post)) {
            return redirect()->route('admin.blog.index')->with([
                'error' => 'You don\'t have permission to delete this post!',
            ]);
        }
        $post->update($request->validated(), ['user_id' => auth()->user()->id]);
        return redirect()->route('admin.blog.index')->with('success', 'The post has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $post = Blog::query()->findOrFail($id);

        if (Gate::denies('delete', $post)) {
            return redirect()->route('admin.blog.index')->with([
                'error' => 'You don\'t have permission to delete this post!',
            ]);
        }

        try {
            $post->delete();
            return redirect()->route('admin.blog.index')->with('success', 'The post has been deleted successfully!');
        } catch (\Exception $exception) {
            \Log::error($exception->getCode().$exception->getLine().$exception->getLine().$exception->getMessage());
            return redirect()->route('admin.blog.index')->with('error',
                'There was an error while deleting the post.');
        }
    }

    public function myPost(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('blog.admin.my-post',
            [
                'posts' => Blog::query()->where('user_id', '=', auth()->user()->id)->paginate(),
            ]);
    }

}
