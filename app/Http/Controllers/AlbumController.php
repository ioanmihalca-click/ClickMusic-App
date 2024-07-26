<?php

namespace App\Http\Controllers;

use App\Mail\ComandaAlbumConfirmare;
use App\Models\Album;
use App\Models\ComandaAlbum;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AlbumController extends Controller
{
    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function checkout(Album $album)
    {
        return redirect($album->payment_link);
    }

    public function checkoutSuccess(Request $request)
{
    return view('checkout.success', ['message' => 'Thank you for your purchase! You will receive an email with download instructions shortly.']);
}
    private function sendConfirmationEmail(ComandaAlbum $comanda)
    {
        Mail::to($comanda->email)->send(new ComandaAlbumConfirmare($comanda));
    }

    private function generateDownloadLink(Album $album)
    {
        return URL::signedRoute('album.download', ['album' => $album->id], now()->addHours(24));
    }

    public function download(Request $request, Album $album)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $filePath = Storage::disk('public')->path($album->file_path);

        return response()->download($filePath, $album->titlu . '.zip');
    }
}