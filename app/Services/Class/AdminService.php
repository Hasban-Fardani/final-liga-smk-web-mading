<?php
namespace App\Services\Class;

use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
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

    public function declinePost(Post $post)
    {
        if ($post->status === 'PENDING' && $post->accepted == false) {
            $post->update(['status' => 'DECLINED']);
        }
        return $post;
    }

    public function getTotalVisitors()
    {
        return Visitor::all()->count();
    }

    public function getTotalPosts()
    {
        return Post::all()->count();
    }

    public function getTotalCreators()
    {
        return Post::all()->pluck('creator_id')->unique()->count();
    }

    public function getTotalPendingPosts()
    {
        return User::where('permission', 'creator')->where('permission', 'admin')->count();
    }
}