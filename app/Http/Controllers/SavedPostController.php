<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePostRequest;
use App\Models\Post;
use App\Models\SavedPost;
use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    //
    public function index(){
        $savedPosts = SavedPost::where('user_id', auth()->user()->id)->get();
        return view('posts.saved', compact('savedPosts'));
    }

    public function store(Post $post){

        if(SavedPost::where('post_id', $post->id)->where('user_id', auth()->user()->id)->exists()){
            return back()->with('error', 'Post already saved');
        }
        
        SavedPost::create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id
        ]);
        return back()->with('success', 'Post saved successfully');
    }

    public function destroy(Post $post){
        SavedPost::where('post_id', $post->id)->where('user_id', auth()->user()->id)->delete();
        return back()->with('success', 'Post removed successfully');
    }
}
