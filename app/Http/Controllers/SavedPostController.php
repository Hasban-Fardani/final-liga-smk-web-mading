<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    //
    public function index(){
        return view('posts.saved');
    }

    public function store(){
        
    }
}
