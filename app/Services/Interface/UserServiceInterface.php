<?php
namespace App\Services\Interface;

use Illuminate\Http\Request;

interface UserServiceInterface {
    public function login(Request $request);
}