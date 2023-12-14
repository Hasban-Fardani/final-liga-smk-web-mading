<?php
namespace App\Services\Class;

use App\Models\Post;
use App\Services\Interface\CreatorServiceInterface;

class CreatorService implements CreatorServiceInterface
{
    public function createPost(array $data)
    {
        return Post::create($data);
    }
}