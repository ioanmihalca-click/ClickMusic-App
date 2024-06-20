<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Video;
use Livewire\Livewire;
use Illuminate\Http\Request;

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

    public function index()
    {
        {
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
        $videos = Video::all(); // Preia toate videoclipurile din baza de date
        return view('admin', ['videos' => $videos]); // Transmite videoclipurile către view
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


    public function setFeaturedVideo(Request $request)
    {
        $validatedData = $request->validate([
            'featured_video_id' => 'required|exists:videos,id',
        ]);

        // Elimină flag-ul "featured" de la toate videoclipurile
        Video::query()->update(['featured' => false]);

        // Setează videoclipul ales ca "featured"
        Video::find($validatedData['featured_video_id'])->update(['featured' => true]);

    
        return redirect()->route('admin')->with('success_featured', 'Videoclipul promovat a fost actualizat cu succes!');
    }

    public function destroy(Video $video) // Injectează direct modelul Video
    {
        $video->delete(); // Sterge videoclipul
        return redirect()->route('admin')->with('success_delete', 'Videoclipul a fost șters cu succes!');
    }

}
