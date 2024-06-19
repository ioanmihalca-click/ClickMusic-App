<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NotificareVideoclipNou;
use Illuminate\Support\Facades\Notification;

class VideoNotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $validatedData = $request->validate([
            'videoUrl' => 'required|url',
            'imageUrl' => 'required|url',
            'videoName' => 'required|string',
        ]);

        $users = User::all(); 

        Notification::send($users, new NotificareVideoclipNou($validatedData['videoUrl'], $validatedData['imageUrl'],$validatedData['videoName']));

        return redirect()->back()->with('success', 'Notificarile au fost trimise cu succes!');
    }
}
