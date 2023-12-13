<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // get categories
        $categories = Category::all();
        $category_information = $categories->where('slug', 'pengumuman')->first();
        
        // get all posts
        // solved n+1 problem using 'with'
        $posts = Post::paginate(8);
            
        $posts_slider = Post::with('creator', 'category', 'tags')->limit(5)->get();
        $posts_featured = Post::with('creator', 'category', 'tags')->where('category_id', $category_information->id)->limit(5)->get();
        
        // return view index
        return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
    }
}
