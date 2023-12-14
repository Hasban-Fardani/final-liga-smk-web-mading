<?php

namespace App\Http\Controllers;

use App\Services\Class\AdminService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function __invoke()
    {
        $this->authorize('admin');
        return view('admin.dashboard');
    }
}
