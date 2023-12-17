<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CreatorPublishPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        //
        $this->authorize('edit-post', $post);
        $post->update([
            'status' => 'PENDING',
        ]);
        return back()->with('success', 'Post has been requested to published');
    }
}
