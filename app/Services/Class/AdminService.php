<?php
namespace App\Services\Class;

use App\Models\Post;
use App\Services\Interface\AdminServiceInterface;

class AdminService implements AdminServiceInterface
{
    public function acceptPost(Post $post)
    {
        if ($post->status === 'PENDING' && $post->accepted == false) {
            $post->update(['status' => 'PUBLISHED', 'accepted' => true]);
        }
        return $post;
    }
}