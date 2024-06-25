<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function updateUsertype(Request $request, User $user)
    {
        // Check if the request is for the correct user (added security check)
        if ($request->user_id != $user->id) {
            return abort(403, 'Unauthorized action.'); // Return a 403 error if not authorized
        }

        $request->validate([
            'usertype' => 'required|in:user,admin,super_user',
        ]);

        $user->update(['usertype' => $request->usertype]);

        return redirect()->back()->with('success_message', 'User type updated successfully.');
    }
}
