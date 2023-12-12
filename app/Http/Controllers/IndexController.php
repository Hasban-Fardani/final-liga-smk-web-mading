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
        $posts = Post::paginate();
        $mostviewed_posts = Post::mostviewed()->paginate();
        $information_posts = Post::information()->paginate();

        // return view index
        return view('index', compact(['posts', 'mostviewed_posts', 'information_posts']));
    }
}
