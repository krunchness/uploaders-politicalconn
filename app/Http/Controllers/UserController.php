<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRole;
class UserController extends Controller
{
    public function usersList()
    {
    	$users = User::all();

    	return view('dashboard.dashboard-usermanagement', compact(['users']));
    }

    public function rolesList()
    {
    	$roles = UserRole::all();

    	return view('dashboard.dashboard-rolesmanagement', compact(['roles']));
    }
}
