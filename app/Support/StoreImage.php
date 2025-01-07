<?php

namespace App\Support;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class StoreImage
{
    public function storeImage($file, $folder = "images")
    {
        try {
            // Extract the mime type and base64 data
            $data = explode(',', $file['image']);
            $mimeType = null;
            if (preg_match('/^data:(image\/\w+);base64,/', $file['image'], $matches)) {
                $mimeType = $matches[1];
            }

            $imageFile = base64_decode($data[1]);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile);

            // Define the file extension based on the MIME type
            $mimeToExtension = [
                'image/jpeg' => 'jpeg',
                'image/png' => 'png',
                'image/gif' => 'gif'
            ];

            $extension = $mimeToExtension[$mimeType] ?? 'jpeg'; // Default to jpeg if MIME type is not recognized
            $filename = uniqid() . '.' . $extension;
            $path = $folder . '/' . $filename;

            $fullPath = storage_path('app/public/' . $path);

            // Save the manipulated image
            $image->save($fullPath);

            // Optionally, get the URL to access the image
            $url = Storage::url($path);

            return ['error' => false, 'url' => $url];
        } catch (\Exception $e) {
            Log::error('Error storing image: ' . $e->getMessage());
            return ['error' => true];
        }
    }
}
