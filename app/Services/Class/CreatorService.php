<?php
namespace App\Services\Class;

use App\Models\Post;
use App\Services\Interface\CreatorServiceInterface;

class CreatorService implements CreatorServiceInterface
{

    public function request(Post $post)
    {
        $post->status = 'PENDING';
        $post->save();
    }
}