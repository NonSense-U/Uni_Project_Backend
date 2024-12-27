<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Service\Drive\Permission;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function upload_pic(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $user = User::find(Auth::id());

        $file = $request->file('file');
        $fileName = $user->username;

        $googleDrivePath = 'uploads/' .$fileName ;


        $uploadSuccess = Storage::disk('google')->put($googleDrivePath, file_get_contents($file));

        if ($uploadSuccess) {

            $client = new \Google\Client();
            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            $client->refreshToken(config('filesystems.disks.google.refreshToken'));

            $service = new \Google\Service\Drive($client);

            // Search for the file by name to get its ID
            $response = $service->files->listFiles([
                'q' => "name='{$fileName}' and trashed=false",
                'fields' => 'files(id, name)',
            ]);

            if (count($response->files) > 0) {
                $fileId = $response->files[0]->id;

                $permission = new Permission();
                $permission->setType('anyone');
                $permission->setRole('reader');
                $service->permissions->create($fileId, $permission);

                $shareableLink = "https://drive.google.com/file/d/{$fileId}/view?usp=sharing";

                $user->profile_pic = $shareableLink;
                $user->save();

                // Return the shareable link
                return response()->json(['link' => $shareableLink]);
            } else {
                return response()->json(['error' => 'File not found after upload.'], 404);
            }
        } else {
            return response()->json(['error' => 'Failed to upload file.'], 500);
        }
    }

    public function delete_pic(Request $request)
    {
        $user = User::find(Auth::id());
        if ($user->profile_pic) {

            // Get the file ID from the Google Drive URL
            $fileId = explode('/', $user->profile_pic);
            $fileId = $fileId[5];
            // dd($fileId);

            $client = new \Google\Client();
            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            $client->refreshToken(config('filesystems.disks.google.refreshToken'));

            $service = new \Google\Service\Drive($client);

            // Delete the file
            $service->files->delete($fileId);

            $user->profile_pic = null;
            $user->save();

            return response()->json(['message' => 'Profile picture deleted successfully']);
        } else {
            return response()->json(['error' => 'No profile picture found'], 404);
        }
    }
}

