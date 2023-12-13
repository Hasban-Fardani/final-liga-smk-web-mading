<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function __invoke(LogoutRequest $request)
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have successfully logged out.');
    }
}
