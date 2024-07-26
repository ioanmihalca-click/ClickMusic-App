<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function checkout(Album $album, Request $request)
    {
        // Validate the email
        $validated = $request->validate(['email' => 'required|email']);
    
        // Check if the email exists
        $user = User::where('email', $validated['email'])->first();
    
        // If the user doesn't exist, create one
        if (!$user) {
            $user = User::create([
                'email' => $validated['email'],
                'password' => bcrypt(Str::random(10)), // Or leave the password blank
            ]);
        }
        
        // ... your existing logic to create a payment link or handle the purchase ...
        // (You'll likely need to associate the purchase with the $user in your payment system)
        
        // After successful purchase, generate download link and send email
        // ... (Add this part after your purchase logic)
    }

}