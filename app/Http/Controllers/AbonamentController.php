<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbonamentController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('abonament', compact('user')); // Pass $user to view
    }
}
