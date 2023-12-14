<?php

namespace App\Http\Controllers;

use App\Services\Class\PostService;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    // 
    public function index(PostService $postService){
        return view('admin.posts', [
            'posts' => $postService->getAll()
        ]);
    }
}
