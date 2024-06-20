<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return view('videos.show', compact('video'));
    }

    public function share($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.share', compact('video'));
    }

    public function create()
    {
        return view('admin'); // Întoarce view-ul admin.blade.php
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'embed_link' => 'required|string', 
            'thumbnail_url' => 'required|url', 
        ]);

        Video::create($validatedData);

        return redirect()->route('videos.create')->with('success', 'Videoclipul a fost adăugat cu succes!'); // Folosim 'success' aici
    }

}
