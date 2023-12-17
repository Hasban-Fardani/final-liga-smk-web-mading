<?php

namespace App\Services\Class;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use App\Services\Interface\AdminServiceInterface;
use Carbon\Carbon;

class AdminService implements AdminServiceInterface
{
    public function acceptPost(Post $post)
    {
        if ($post->status === 'PENDING' || $post->status === 'DRAFT') {
            $post->update(['status' => 'PUBLISHED', 'accepted' => true]);
        }
        return $post;
    }

    public function declinePost(Post $post)
    {
        if ($post->status === 'PENDING' && $post->accepted == false) {
            $post->update(['status' => 'DECLINED']);
        }
        return $post;
    }

    public function getTotalVisitors()
    {
        return Visitor::all()->count();
    }

    public function getTotalPosts()
    {
        return Post::all()->count();
    }

    public function getTotalPendingPosts()
    {
        return Post::where('status', 'PENDING')->count();
    }

    public function getTotalCreators()
    {
        return User::where('permission', 'creator')->orWhere('permission', 'admin')->count();
    }

    public function getVisitorsPerDayOfMonth($month, $year)
    {
        $result = [];

        for ($i = 0; $i < Carbon::now()->daysInMonth + 1; $i++) {
            $count = Visitor::whereYear('visited_at', $year)
                            ->whereMonth('visited_at', $month)
                            ->whereDay('visited_at', $i + 1)
                            ->count();
            array_push($result, $count);
        }
        
        return $result;
    }

    public function getVisitorsPerCategory()
    {
        
        $result = [[], []];
        $cateories = Category::all(['id', 'name']);

        foreach ($cateories as $category) {
            $views = Post::where('category_id', $category->id)->sum('views');
            array_push($result[0], $category->name);
            array_push($result[1], $views);
        }
        return $result;
    }
}
