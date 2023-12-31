<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Class\UserService;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, UserService $userService)
    {
        $user = $userService->login($request);
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        
        if ($user->permission == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Login successfully');
        }

        if ($user->permission == 'creator') {
            return redirect()->route('creator.dashboard')->with('success', 'Login successfully');
        }

        return redirect()->route('index')->with('success', 'Login successfully');
    }
}
