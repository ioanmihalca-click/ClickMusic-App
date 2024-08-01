<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function 
 subscribe(Request $request)
    {
        $validatedData 
 = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|email|unique:newsletters,recipient_email',
        ]);

        Newsletter::create([
            'recipient_name' => $validatedData['name'],
            'recipient_email' => $validatedData['email'],
            'status' => 'pending', 
        ]);

        return redirect()->back()->with('success', 'V-ați abonat cu succes la newsletter!'); 
    }
}
