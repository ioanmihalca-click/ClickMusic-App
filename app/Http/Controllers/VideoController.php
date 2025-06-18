<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Livewire\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        // Check if user is authenticated but not premium (free tier)
        $showUpsell = false;

        if (Auth::check()) {
            $showUpsell = !Auth::user()->isPremium();
        }

        return view('videos.show', [
            'video' => $video,
            'showUpsell' => $showUpsell || session()->has('upsell')
        ]);
    }

    public function share($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.share', compact('video'));
    }

    public function index()
    { {
            $videos = Video::orderBy('created_at', 'desc')->get();
            $users = User::all(); // Preia toți utilizatorii

            return view('admin', [
                'videos' => $videos,
                'users' => $users // Transmite utilizatorii către view
            ]);
        }
    }

    public function create()
    {
        return view('admin');
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

        return redirect()->route('videoclipuri')->with('success', 'Videoclipul a fost adăugat cu succes!'); // Folosim 'success' aici
    }


    public function setFeaturedVideo(Request $request)
    {
        $validatedData = $request->validate([
            'featured_video_id' => 'required|exists:videos,id',
        ]);

        // Elimină flag-ul "featured" de la toate videoclipurile
        Video::query()->update(['featured' => false]);

        // Setează videoclipul ales ca "featured"
        Video::find($validatedData['featured_video_id'])->update(['featured' => true]);


        return redirect()->route('videoclipuri')->with('success_featured', 'Videoclipul promovat a fost actualizat cu succes!');
    }


    public function update(Request $request, Video $video)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255', // Adăugat max:255 pentru a limita lungimea titlului
            'description' => 'required|string',
        ]);

        $video->update($validatedData);

        return redirect()->route('videoclipuri')->with('success_edit', 'Videoclipul a fost actualizat cu succes!');
    }


    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videoclipuri')->with('success_message', 'Videoclipul a fost șters cu succes!');
    }

    /**
     * Stream a video securely to authenticated users only
     * 
     * @param int $id
     * @return StreamedResponse
     */
    public function stream($id)
    {
        $video = Video::findOrFail($id);

        // Check if video has a file path
        if (empty($video->video_path)) {
            abort(404, 'Fișierul video nu a fost găsit');
        }

        // Double-check that the user is premium (middleware should handle this, but adding extra security)
        if (Auth::check() && !Auth::user()->isPremium()) {
            return redirect()->route('videos.show', $video->id)->with('upsell', true);
        }

        // Get file path from storage
        $path = $video->video_path;

        // Check if file exists using public disk (changed from videos disk)
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Fișierul video nu a fost găsit');
        }

        // Stream the file from public disk
        $fullPath = Storage::disk('public')->path($path);

        // Use mime_content_type to detect the mime type
        $mimeType = mime_content_type($fullPath) ?: 'video/mp4';

        return Response::file($fullPath, [
            'Content-Type' => $mimeType,
            'Accept-Ranges' => 'bytes',
        ]);
    }
}
