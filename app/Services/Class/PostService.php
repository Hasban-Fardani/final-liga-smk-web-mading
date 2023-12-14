<?php
namespace App\Services\Class;

use App\Models\Category;
use App\Models\Post;
use App\Services\Interface\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function getAll()
    {
        // solved n+1 problem using 'with'
        return Post::with(['Category', 'Creator', 'Tags'])->get();
    }
    public function getByCategory(string $categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        return Post::with(['Category', 'Creator', 'Tags'])->where('category_id', $category->id)->get();
    }
    public function searchTitle(string $title)
    {
        return Post::where('title', 'like', '%' . $title . '%')->get();
    }
    public function searchContent(string $content)
    {
        
    }
}