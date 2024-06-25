<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SuperUserNotification;

class UserController extends Controller
{
    public function updateUsertype(Request $request)  // Remove User $user here
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', 
            'usertype' => 'required|in:user,admin,super_user',
        ]);

        $user = User::findOrFail($request->user_id); // Find the user by ID

        // Additional check: Make sure you aren't trying to change your own user type
        if ($user->id == auth()->id()) { 
            return redirect()->back()->with('error_message', 'You cannot change your own user type.');
        }

        $user->update(['usertype' => $request->usertype]);

        if ($request->usertype === 'super_user') {
            $user->notify(new SuperUserNotification()); // Send the notification
        }

        return redirect()->back()->with('success_message', 'User type updated successfully.');
    }
}
