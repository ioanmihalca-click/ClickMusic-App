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
}
