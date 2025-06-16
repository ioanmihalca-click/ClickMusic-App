<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => [
                    'required',
                    'image',
                    'max:2048', // 2MB în kilobytes
                    'mimes:jpeg,png,jpg,gif,webp'
                ]
            ], [
                'avatar.max' => 'Imaginea trebuie să fie mai mică de 2MB.',
                'avatar.mimes' => 'Formatul imaginii trebuie să fie: jpeg, png, jpg sau gif.',
                'avatar.image' => 'Fișierul trebuie să fie o imagine.'
            ]);

            // Obține utilizatorul curent
            $user = User::find(Auth::id());

            // Salvăm imaginea veche pentru a o șterge după ce am salvat cu succes noua imagine
            $oldAvatar = $user->avatar;

            // Salvează imaginea nouă în storage/app/public/avatars
            $path = $request->file('avatar')->store('avatars', 'public');

            // Actualizează calea către avatar în baza de date
            $user->update(['avatar' => $path]);

            // Acum, după ce am salvat noua imagine, ștergem imaginea veche dacă există
            if ($oldAvatar) {
                // Extragem numele fișierului din URL sau cale
                $filename = null;

                // Pentru URL-uri complete (https://clickmusic-app.test/storage/avatars/...)
                if (filter_var($oldAvatar, FILTER_VALIDATE_URL)) {
                    $parsedUrl = parse_url($oldAvatar);
                    if (isset($parsedUrl['path'])) {
                        $pathParts = explode('/', $parsedUrl['path']);
                        $filename = end($pathParts);
                    }
                } else {
                    // Pentru cazul când avem doar calea relativă (avatars/filename.jpg)
                    $pathParts = explode('/', $oldAvatar);
                    $filename = end($pathParts);
                }

                if ($filename) {
                    $filePath = 'avatars/' . $filename;

                    Log::debug('Avatar delete attempt', [
                        'old_avatar' => $oldAvatar,
                        'extracted_filename' => $filename,
                        'file_path_to_delete' => $filePath,
                        'exists' => Storage::disk('public')->exists($filePath)
                    ]);

                    // Ștergem fișierul dacă există
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                        Log::debug('Avatar deleted successfully', ['path' => $filePath]);
                    }
                } else {
                    Log::warning('Could not extract filename from avatar path', ['avatar' => $oldAvatar]);
                }
            }

            return back()->with('status', 'avatar-updated');
        } catch (\Exception $e) {
            Log::error('Avatar update error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['avatar' => 'Eroare la încărcare: ' . $e->getMessage()]);
        }
    }
}
