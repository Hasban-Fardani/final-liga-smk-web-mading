<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\Class\PostService;
use Illuminate\Http\Request;

class SearchPostController extends Controller
{
    //
    public function __invoke(Request $request, PostService $postService)
    {
        $categories = Category::all();
        $posts = $postService->search($request->q, ['id', 'title', 'slug', 'image', 'category_id', 'creator_id']);
        $tags = Tag::all();
        
        if ($request->category) {
            $category_id = Category::where('name', $request->category)->first()->id;
            $posts = collect($posts->whereIn('category_id', $category_id));
        }

        if ($request->tag) {
            $tag_id = Tag::where('name', $request->tag)->first()->id;
            $ids = PostTag::where('tag_id', $tag_id)->pluck('post_id');
            $posts = collect($posts->whereIn('id', $ids));
        }
        
        return view('search', compact(['posts', 'categories', 'tags']));
    }
}
