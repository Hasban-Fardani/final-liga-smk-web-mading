<?php
namespace App\Services\Interface;

use App\Http\Requests\LoginRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface {
    public function login(LoginRequest $request);
    public function readPost(Request $request, Post $post);
}