<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request)
    {
        $profilePicture = $request->profile_picture;
        if(is_array($request->profile_picture)){
            $profilePicture = $this->storeImage($request->profile_picture);
        }
        $request->user()->fill($request->validated());

        $request->user()->profile_picture = $profilePicture;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('account-settings');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function storeImage($uploadedImage)
    {
        try {
            // Extract the mime type and base64 data
            $data = explode(',', $uploadedImage['image']);
            $mimeType = null;

            if (preg_match('/^data:(image\/\w+);base64,/', $uploadedImage['image'], $matches)) {
                $mimeType = $matches[1];
            }

            $imageFile = base64_decode($data[1]);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile);

            // Define the file extension based on the MIME type
            $extension = str_replace('image/', '', $mimeType) ?: 'jpeg'; // Default to jpeg if not specified
            $filename = uniqid() . '.' . $extension;
            $path = 'images/' . $filename;
            $fullPath = storage_path('app/public/' . $path);

            // Save the manipulated image
            $image->save($fullPath);

            // Optionally, get the URL to access the image
            $url = Storage::url($path);


            return $url;
        } catch (\Exception $e) {
            Log::error('Error storing image: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store image'], 500);
        }
    }
}
