<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\Class\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(public PostService $postService)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = $this->postService->getByCreator(auth()->user()->username);
        if (auth()->user()->permission === 'admin') {
            $posts = $this->postService->getAll();
        } 
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        $this->postService->create($request);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $categories = Category::all();
        $tag_id = PostTag::where('post_id', $post->id)->pluck('tag_id')->toArray();
        $tags = Tag::whereIn('id', $tag_id)->get();
        foreach ($tags as $tag) {
            PostTag::where('post_id', $post->id)->where('tag_id', $tag->id)->delete();
        }

        return view('posts.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        $this->postService->update($request, $post);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $this->postService->delete($post);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
