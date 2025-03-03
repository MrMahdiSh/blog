<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->index();
        return $this->response($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $data['user_id'] = $request->user()->id;

        $post = $this->postService->store($data);
        return $this->response($post, "Post created successfully", 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);
        $data['id'] = $id;

        $updatedPost = $this->postService->update($data);
        return $this->response($updatedPost, "Post updated successfully");
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);

        $this->postService->destroy($id);
        return $this->response(null, "Post deleted successfully");
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return $this->response($post);
    }
}
