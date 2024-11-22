<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
        $this->middleware('isAdmin')->only('store', 'update', 'destroy');

    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $blog = Blog::query()->latest()->paginate();
        return response()->json($blog);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request): JsonResponse
    {
        $publishedAt = $request->input('published_at');

        if (Carbon::hasFormat($publishedAt, 'Y-m-d')) {
            $publishedAt = Carbon::parse($publishedAt)->setTime(0, 0);
        } else {
            $publishedAt = Carbon::parse($publishedAt);
        }

        $post = Blog::query()->create($request->validated() + ['user_id' => auth()->user()->id]);

        return response()->json($post);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $post = Blog::query()->find($id);
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id): JsonResponse
    {
        $post = Blog::query()->findOrFail($id);
        $post->update($request->validated() + ['user_id' =>auth()->user()->id]);

        return response()->json([
            'message' => 'Updated successfully',
            'data' => $post
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $blog = Blog::query()->findOrFail($id);
        $blog->delete();
        return response()->json('Blog deleted successfully', Response::HTTP_OK);
    }
}
