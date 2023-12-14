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
        $category_information = $categories->where('slug', 'pengumuman')->first();

        $posts_slider = Post::with('creator', 'category', 'tags')->limit(5)->get();
        $posts_featured = Post::orderBy('views', 'desc')->with('creator', 'category', 'tags')->where('category_id', $category_information->id)->limit(5)->get();

        if ($request->input('search')) {
            $posts = $postService->searchTitle($request->input('search'));
            // return view index
            return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
        }

        if ($request->input('category')) {
            $posts = $postService->getByCategory($request->input('category'));
            // return view index
            return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
        }

        // get all posts
        $posts = $postService->getAll();

        // return view index
        return view('index', ['posts' => $posts, 'posts_slider' => $posts_slider, 'posts_featured' => $posts_featured, 'categories' => $categories]);
    }
}
