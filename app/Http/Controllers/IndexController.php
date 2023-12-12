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
        $posts = Post::select(['id', 'title', 'slug', 'image', 'excerpt'])->paginate(5);
        // $images_featured = Post::images()->get();
        // dd($images_featured);
        // return view index
        return view('index', compact(['posts']));
    }
}
