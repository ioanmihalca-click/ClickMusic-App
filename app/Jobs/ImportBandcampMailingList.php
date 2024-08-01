<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Log;

// class ImportBandcampMailingList implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     public function handle()
//     {
//         $filePath = storage_path('app/mailing_list_Bandcamp.xml');

//         try {
//             $xmlData = simplexml_load_file($filePath);

//             foreach ($xmlData->subscriber as $subscriber) {
//                 $emailAddress = (string) $subscriber->recipient_email;
//                 $name = (string) $subscriber->recipient_name;

//                 // Validare email (opțional, dar recomandat)
//                 if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
//                     Log::warning("Invalid email address in XML: {$emailAddress}");
//                     continue; // Skip to the next email if invalid
//                 }

//                 // Gestionare duplicate (opțiune 1: ignoră duplicatele)
//                 if (Newsletter::where('recipient_email', $emailAddress)->exists()) {
//                     Log::info("Duplicate email address in XML: {$emailAddress}. Skipping.");
//                     continue; 
//                 }

//                 // Creează înregistrarea în baza de date
//                 Newsletter::create([
//                     'recipient_email' => $emailAddress,
//                     'recipient_name' => $name,
//                     'status' => 'pending', 
//                 ]);
//             }

//             Log::info('Import from Bandcamp mailing list completed successfully.');

//         } catch (\Exception $e) {
//             Log::error('Error importing Bandcamp mailing list: ' . $e->getMessage());
//         }
//     }
// }
