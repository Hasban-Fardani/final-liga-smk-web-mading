<?php

namespace App\Http\Controllers;

use App\Services\Class\AdminService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function __invoke(AdminService $adminService)
    {
        $this->authorize('admin');

        $total_visitors      = $adminService->getTotalVisitors();
        $total_posts         = $adminService->getTotalPosts();
        $total_pending_posts = $adminService->getTotalPendingPosts();
        $total_creators      = $adminService->getTotalCreators();
        return view('admin.dashboard', compact([
            'total_visitors', 
            'total_posts', 
            'total_creators', 
            'total_pending_posts'
        ]));
    }
}
