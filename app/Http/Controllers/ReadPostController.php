<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\Class\UserService;
use Illuminate\Http\Request;

class ReadPostController extends Controller
{
    //
    public function __invoke(Request $request, Post $post, UserService $userService)
    {
        $post = $userService->readPost($request, $post);
        return view('read-post', compact('post'));
    }
}
