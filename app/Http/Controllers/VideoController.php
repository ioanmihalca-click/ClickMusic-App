<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Models\Video; // Import your Video model if applicable
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function getVideos()
{
    try {
        // Fetch video data from your database or source
        $videos = Video::all(); // Assuming you're using Eloquent

        // Format video data and generate playback URLs
        foreach ($videos as $video) {
            $video->playbackUrl = $this->getBunnyStreamPlaybackUrl($video->id);
        }

        // Pass video data to the view
        return view('video-dashboard', compact('videos'));
    } catch (\Exception $e) {
        // Handle exceptions
        // Log the error or show an error message to the user
        return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
    }
}

    private function getBunnyStreamPlaybackUrl(int $videoId)
    {
        $client = new Client();

        $response = $client->request('GET', 'https://cdn.bunnycdn.com/api/streams/' . $videoId, [
            'headers' => [
                'Authorization' => 'Bearer ' . env('BUNNY_STREAM_API_KEY'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Check if the response contains the playback URL
        if (isset($data['playback_url'])) {
            return $data['playback_url'];
        } else {
            // If playback URL is not found, throw an exception or return null
            throw new \Exception('Playback URL not found in Bunny Stream API response.');
        }
    }
}
