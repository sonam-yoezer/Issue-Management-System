<?php

namespace App\Http\Controllers;

use App\Models\User; // Import User model
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function registeredUsers()
    {
        // Fetch only users with the role 'user'
        $users = User::where("role", "user")->get();  
        
        // Pass the users data to the view
        return view('admin.user', compact('users')); 
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User not found.');
        }

        return view('admin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User not found.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.user')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
    }
}
