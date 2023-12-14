<?php

namespace App\Services\Class;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Interface\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function getAll()
    {
        // get all published posts
        return Post::with(['category', 'creator', 'tags', 'comments'])
            ->get();
    }

    public function getAllPublished()
    {
        // get all published posts
        return Post::with(['category', 'creator', 'tags', 'comments'])
            ->published()
            ->get();
    }

    public function getByCategory(string $categorySlug)
    {
        return Post::with(['category', 'creator', 'tags', 'comments'])
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->published()
            ->accepted()
            ->get();
    }

    public function getByCreator(string $creatorUsername, bool $published = false)
    {
        $post = Post::with(['category', 'creator', 'tags', 'comments'])
            ->whereHas('creator', function ($query) use ($creatorUsername) {
            $query->where('username', $creatorUsername);
            });
        if ($published) {
            $post->published();
        }
        return $post->get();
    }
    public function search(string $query)
    {
        return  Post::with(['category', 'creator', 'tags', 'comments'])
            ->search($query)
            ->get();
    }

    public function create(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = new Post();
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->category_id = $data['category_id'];
        $post->creator_id = auth()->user()->id;
        $post->slug = $data['slug'];
        $post->excerpt = $data['excerpt'];

        // set base dir
        $baseDir = 'images/posts/';
        $post->image = $baseDir . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path($baseDir), $request->file('image')->getClientOriginalName());
        $post->save();
        return $post;
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        return $post->update($data);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
