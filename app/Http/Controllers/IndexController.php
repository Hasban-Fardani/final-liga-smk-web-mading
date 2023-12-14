<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
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
        $posts_slider = Post::with('creator', 'category', 'tags')
            ->published()
            ->limit(5)
            ->get();

        // get post for featured
        $posts_featured = Post::orderBy('published_at', 'desc')
            ->with('creator', 'category', 'tags')
            ->category('pengumuman')
            ->published()
            ->limit(5)
            ->get();

        if ($request->input('search')) {
            $posts = $postService->search($request->input('search'));
            
            return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
        }

        if ($request->input('category')) {
            $posts = $postService->getByCategory($request->input('category'));
            
            return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
        }

        // get all posts
        $posts = $postService->getAllPublished();
        
        return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
    }
}
