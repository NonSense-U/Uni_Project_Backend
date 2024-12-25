<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function upload_pic(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Set the Google Drive path
        $googleDrivePath = 'uploads/' . $file->getClientOriginalName();

        // Upload the file
        if (Storage::disk('google')->put($googleDrivePath, file_get_contents($file))) {
             dd("File uploaded successfully!");
        } else {
            dd ("Failed to upload file.");
        }
    }
}
