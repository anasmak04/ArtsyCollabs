<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(User $user)
    {
        $users = User::all();
        $userstatistic = User::count();
        $projectstatistic = Project::count();
        $partnerstatistic = Partner::count();
        $roles = Role::all();


        return view("user.index" , compact("users",
            "userstatistic", "projectstatistic" , "partnerstatistic" , "roles"));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("user.index");
    }


    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user->role_id = $validatedData['role_id'];
        $user->save();
        return redirect()->route('user.index')->with('success', 'User role updated successfully.');
    }


}
