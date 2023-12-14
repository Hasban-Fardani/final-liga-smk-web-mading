<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Class\AdminService;
use Illuminate\Http\Request;

class PostPublishController extends Controller
{
    //
    public function __invoke(AdminService $adminService, Post $post)
    {
        $adminService->acceptPost($post);
        return redirect()->route('posts.index')->with('success', 'Post published successfully');
    }
}
