<?php

namespace App\Http\Controllers;
 
use App\DataTables\UsersDataTable;
use App\Models\User;

class DTUsersController extends Controller
{
    public function index()
    {
        return view('user-dt', [
            'users' => User::all(),
        ]);
    }
}