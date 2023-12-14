<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostCreateController extends Controller
{
    //
    public function __invoke()
    {
        return view('posts.create');
    }
}
