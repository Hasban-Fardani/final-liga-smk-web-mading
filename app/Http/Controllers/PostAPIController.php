<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostAPIController extends Controller
{
    //
    public function __invoke()
    {
        return PostResource::collection(Post::all());
    }
}
