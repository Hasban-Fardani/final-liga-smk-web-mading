<?php

namespace App\Services\Interface;

use App\Models\Post;

interface CreatorServiceInterface
{
    public function request(Post $post);
}