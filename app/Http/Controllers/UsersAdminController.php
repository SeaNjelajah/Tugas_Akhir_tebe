<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersAdminController extends Controller
{
    public function index () {
        $users = User::all();
        return view('admin.user_admin.index', compact('users'));
    }
}
