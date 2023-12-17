<?php

namespace App\Services\Class;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Services\Interface\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class PostService implements PostServiceInterface
{
    public function getAll()
    {
        return Post::all();
    }
    public function getAllPublished($columns=['*'], $limit = null)
    {
        // get all published posts
        $posts = Post::with(['category', 'creator', 'tags', 'comments'])
            ->published()
            ->orderBy('published_at', 'desc')
            ->get($columns);

        if ($limit) {
            return $posts->take($limit);
        }
        return $posts;
    }
        
    public function getByCategory(string $categorySlug, $limit = null)
    {
        $post = Post::with(['category', 'creator', 'tags', 'comments'])
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->orderBy('created_at', 'desc');
        
        if ($limit) {
            return $post->take($limit)->get();
        }
        return $post->get();
    }

    public function getByCreator(string $creatorUsername, bool $published = false, $columns = ['*'])
    {
        $post = Post::with(['category', 'creator', 'tags', 'comments'])
            ->whereHas('creator', function ($query) use ($creatorUsername) {
                $query->where('username', $creatorUsername);
            })
            ->orderBy('created_at', 'desc');
        if ($published) {
            $post->where('published_at', '<=', now());
        }
        return $post->get($columns);
    }
    public function search($query, $columns = ['*']) : SupportCollection
    {
        if (!$query) {
            return collect($this->getAllPublished($columns));
        }
        $posts = collect(Post::with(['category', 'creator', 'tags', 'comments'])
            ->search($query)
            ->where('published_at', '<=', now())
            ->where('status', 'PUBLISHED')
            ->where('accepted', true)
            ->get($columns));
        return $posts;
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
        $post->excerpt = $data['excerpt'] ? $data['excerpt'] : $post->createExcerpt();

        // set base dir
        $baseDir = '/images/posts/';
        $post->image = $baseDir . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path($baseDir), $request->file('image')->getClientOriginalName());

        // check admin
        if (auth()->user()->permission === 'admin') {
            $post->accepted = true;
        }

        if ($data['publish'] == 'now') {
            $post->published_at = now();
            $post->status = "PUBLISHED";
        } else {
            if (isset($data['published_at'])) {
                $post->published_at = $data['published_at'];
            }
        }
        

        $post->save();

        $tags=explode(',', $data['tags']);
        foreach ($tags as $tag) {
            if (Tag::where('name', $tag)->exists()) {
                $tag = Tag::where('name', $tag)->first();
            } else {
                $tag = Tag::create(['name' => $tag]);
            }
            $post->tags()->create(['tag_id' => $tag->id, 'post_id' => $post->id]);
        }

        $post->save();
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validated();
        return $post->update($data);
    }

    public function delete(Post $post)
    {
        return $post->delete();
    }
}
