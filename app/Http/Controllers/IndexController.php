<?php

namespace App\Http\Controllers;

use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $posts = Post::paginate(5);
        // $images_featured = Post::images()->get();
        // dd($posts[0]->category->name);
        // return view index
        return view('index', compact(['posts']));
    }
}
