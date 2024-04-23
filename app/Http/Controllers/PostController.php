<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('auth:api');
        $this->postService = $postService;
    }

    public function index()
    {
        return response()->json(PostResource::collection(Post::all()));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(new PostResource($this->postService->createPost($request)));
    }

    public function show($id)
    {
        return response()->json(new PostResource(Post::findOrFail($id)));
    }

    public function update(StoreRequest $request, $id)
    {
        return response()->json(PostResource::make($this->postService->updatePost($request,$id)));
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        return response()->json([
            'status' => 'success',
            'message' => 'Post deleted successfully',
        ]);
    }
}
