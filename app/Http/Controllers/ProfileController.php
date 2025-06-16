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

            // Salvează temporar imaginea pentru cropping
            $tempPath = $request->file('avatar')->store('temp/avatars', 'public');

            // Redirecționează către pagina de cropping
            return redirect()->route('profile.avatar.crop', ['image' => $tempPath]);
        } catch (\Exception $e) {
            Log::error('Avatar upload error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['avatar' => 'Eroare la încărcare: ' . $e->getMessage()]);
        }
    }

    public function showCropForm(Request $request)
    {
        $tempImage = $request->query('image');

        if (!$tempImage || !Storage::disk('public')->exists($tempImage)) {
            return redirect()->route('profile.edit')->withErrors(['avatar' => 'Imaginea temporară nu a fost găsită.']);
        }

        $imageUrl = asset('storage/' . $tempImage);

        return view('profile.crop-avatar', [
            'imageUrl' => $imageUrl,
            'tempImage' => $tempImage
        ]);
    }

    public function cropAvatar(Request $request)
    {
        try {
            $request->validate([
                'croppedImage' => 'required',
                'tempImage' => 'required|string'
            ]);

            // Decode croppedImage din base64
            $base64Image = $request->input('croppedImage');
            $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
            $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData = base64_decode($base64Image);

            if (!$imageData) {
                throw new \Exception('Imaginea nu a putut fi decodată.');
            }

            // Creează o imagine de la datele decodate
            $tempFile = tempnam(sys_get_temp_dir(), 'avatar');
            file_put_contents($tempFile, $imageData);

            // Încarcă imaginea folosind GD
            $image = imagecreatefromstring($imageData);
            if (!$image) {
                throw new \Exception('Nu s-a putut crea imaginea din datele primite.');
            }

            // Redimensionează la o dimensiune rezonabilă dacă este prea mare
            // Obține dimensiunile curente
            $width = imagesx($image);
            $height = imagesy($image);

            // Dacă imaginea este mai mare de 300x300, o redimensionăm
            $maxDimension = 300;
            if ($width > $maxDimension || $height > $maxDimension) {
                if ($width > $height) {
                    $newWidth = $maxDimension;
                    $newHeight = intval($height * ($maxDimension / $width));
                } else {
                    $newHeight = $maxDimension;
                    $newWidth = intval($width * ($maxDimension / $height));
                }

                $resized = imagecreatetruecolor($newWidth, $newHeight);
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($image);
                $image = $resized;
            }

            // Obține un nume de fișier unic pentru imaginea finală - folosim jpg pentru compresie mai bună
            $filename = 'avatar_' . time() . '_' . uniqid() . '.jpg';
            $finalPath = 'avatars/' . $filename;

            // Salvează imaginea optimizată
            $tempOutput = tempnam(sys_get_temp_dir(), 'avatar_output');
            imagejpeg($image, $tempOutput, 85); // Calitate 85% - un bun echilibru între calitate și dimensiune
            imagedestroy($image);

            // Încarcă imaginea optimizată în storage
            $optimizedImageData = file_get_contents($tempOutput);
            Storage::disk('public')->put($finalPath, $optimizedImageData);

            // Curăță fișierele temporare
            @unlink($tempFile);
            @unlink($tempOutput);

            // Verifică și logează dimensiunea fișierului optimizat
            $fileSize = Storage::disk('public')->size($finalPath);
            Log::info('Avatar saved with optimization', [
                'path' => $finalPath,
                'size' => $fileSize,
                'size_kb' => round($fileSize / 1024, 2) . ' KB'
            ]);

            // Obține utilizatorul curent
            $user = User::find(Auth::id());

            // Salvăm imaginea veche pentru a o șterge după ce am salvat cu succes noua imagine
            $oldAvatar = $user->avatar;

            // Actualizează calea către avatar în baza de date
            $user->update(['avatar' => $finalPath]);

            // Șterge fișierul temporar
            $tempImage = $request->input('tempImage');
            if (Storage::disk('public')->exists($tempImage)) {
                Storage::disk('public')->delete($tempImage);
            }

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

            return redirect()->route('profile.edit')->with('status', 'avatar-updated');
        } catch (\Exception $e) {
            Log::error('Avatar crop error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['avatar' => 'Eroare la procesarea imaginii: ' . $e->getMessage()]);
        }
    }
}
