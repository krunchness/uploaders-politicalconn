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
        $roles = UserRole::all();

    	return view('dashboard.dashboard-usermanagement', compact(['users', 'roles']));
    }

    public function rolesList()
    {
    	$roles = UserRole::all();

    	return view('dashboard.dashboard-rolesmanagement', compact(['roles']));
    }

    public function addUser(Request $request)
    {
       // dd($request->all());

       User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_role' => $request->user_role,
       ]);

       return redirect()->route('usermanagement.usersList');
    }

    public function addRole(Request $request)
    {

        UserRole::create($request->all());

        return redirect()->route('usermanagement.rolesList');
    }
}
