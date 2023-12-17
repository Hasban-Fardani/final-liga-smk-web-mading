<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Services\Class\AdminService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function __invoke(AdminService $adminService, Request $request)
    {
        $this->authorize('admin');

        $month               = $request->get('month') ? $request->get('month') : date('m');
        $year                = $request->get('year') ? $request->get('year') : date('Y');

        $total_visitors      = $adminService->getTotalVisitors();
        $total_posts         = $adminService->getTotalPosts();
        $total_pending_posts = $adminService->getTotalPendingPosts();
        $total_creators      = $adminService->getTotalCreators();

        $visitors            = $adminService->getVisitorsPerDayOfMonth($month, $year);
        $visitors_categories = $adminService->getVisitorsPerCategory();

        $visitors_table      = Visitor::all();

        // dd($visitors_categories);
        return view('admin.dashboard', compact([
            'month',
            'year',
            'total_visitors', 
            'total_posts', 
            'total_creators', 
            'total_pending_posts',
            'visitors',
            'visitors_categories',
            'visitors_table'
        ]));
    }
}
