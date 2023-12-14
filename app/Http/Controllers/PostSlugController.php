<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PostSlugController extends Controller
{
    //
    public function __invoke(Request $request, SlugService $service)
    {
        $slug = $service->createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
