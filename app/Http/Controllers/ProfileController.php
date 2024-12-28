<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => ['required', 'image', 'max:1024']
            ]);
    
            // Salvează imaginea în storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');
    
            User::where('id', Auth::id())->update(['avatar' => $path]);
    
            return back()->with('status', 'avatar-updated');
        } catch (\Exception $e) {
            return back()->withErrors(['avatar' => 'Eroare la încărcare: ' . $e->getMessage()]);
        }
    }
}