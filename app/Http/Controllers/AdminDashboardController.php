<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function __invoke()
    {
        $this->authorize('admin');
    }
}
