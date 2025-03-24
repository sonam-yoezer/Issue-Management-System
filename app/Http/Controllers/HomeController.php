<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use App\Models\Issues; // Import the Issues model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $users = User::where("role", "user")->get(); // Fetch only users with role 'user'
        $issues = Issues::with('user')->get(); // Fetch issues with assigned user
        return view('admin.dashboard', compact('users', 'issues')); // Pass users and issues to the view
    }

}
