<?php

namespace App\Services\Interface;

use App\Models\Post;

interface AdminServiceInterface {
    public function acceptPost(Post $post);
    public function declinePost(Post $post);
    public function getTotalVisitors();
    public function getTotalPosts();
    public function getTotalPendingPosts();
    public function getTotalCreators();
}