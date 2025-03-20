<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model
use App\Models\Issues; // Import the Issues model
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $users = User::where("role", "technician")->get(); 
        $issues = Issues::with('user')->get();
        return view('admin.dashboard', compact('users', 'issues')); }
}
