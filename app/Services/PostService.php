<?php

namespace App\Services;

use App\Models\Post;

class PostService extends BaseService
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    // Override index to include user relationship and pagination
    public function index()
    {
        return $this->model::with('user')->paginate(10);
    }
}
