<?php

namespace App\Services\Interface;

use App\Models\Post;

interface AdminServiceInterface {
    public function acceptPost(Post $post);
}