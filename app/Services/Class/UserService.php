<?php
namespace App\Services\Class;

use App\Http\Requests\LoginRequest;
use App\Models\Post;
use App\Models\Visitor;
use App\Services\Interface\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface {
    /**
     * Authenticates a user based on the provided login credentials.
     *
     * @param LoginRequest $request The login request object.
     * @return mixed|bool The authenticated user if successful, false otherwise.
     */
    public function login(LoginRequest $request){
        Auth::attempt($request->except('_token'));
        if(Auth::check()){
            return auth()->user();
        }
        return false;
    }

    public function readPost(Request $request, Post $post){
        $post->views += 1;
        $post->save();
        
        $visitor = new Visitor();
        if (Auth::check()){
            $visitor->user_id = Auth::user()->id;
        } else {
            $visitor->user_id = null;
        }

        $visitor->ip_address = $request->ip();
        $visitor->user_agent = $request->header('User-Agent');
        $visitor->post_id = $post->id;
        $visitor->save();
        return $post;
    }
}