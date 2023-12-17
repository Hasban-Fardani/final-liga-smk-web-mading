<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Visitor;
use App\Services\Class\PostService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, PostService $postService)
    {
        // get categories
        $categories = Category::all();

        // get post for slider
        
        $posts_slider = $postService->getByCategory('prestasi', 5);

        // get post for featured
        $posts_featured = $postService->getAllPublished(['id','title', 'slug', 'image', 'views', 'creator_id', 'published_at'], 5);

        // get all posts
        $posts = $postService->getAllPublished();
        
        Visitor::create([
            'user_id' => $request->user() ? $request->user()->id : null,
            'slug' => '/',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
    }
}
