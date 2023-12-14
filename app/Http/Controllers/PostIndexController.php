<?php

namespace App\Http\Controllers;

use App\Services\Class\PostService;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{
    //
    public function __invoke(PostService $postService)
    {
        $posts = $postService->getByCreator(auth()->user()->username);
        return view('posts.index', compact('posts'));
    }
}
