<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;
use App\Http\Requests\Settings\CompanyProfileRequest;
use App\Http\Requests\Settings\SocialMediaRequest;
use App\Http\Requests\Settings\MaintenanceRequest;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;


class GeneralSettingController extends Controller
{
    public function __construct(
        private BaseRepositoryInterface $baseRepository,
        private SettingRepositoryInterface $settingRepository
    ) {
    }

    /**
     * Display the settings view.
     */
    public function view(): Response
    {
        $settings = $this->baseRepository->search(\App\Models\Settings::class, [], ['id', 'field_name','value'], [], [], [], true);

        return Inertia::render('Settings/GeneralSettings/IndexView', [
            'status' => session('status'),
            'settings' => $settings
        ]);
    }

    /**
     * Update the company profile
     */
    public function companyProfile(CompanyProfileRequest $request)
    {
        $validated = $request->validated();

        if(is_array($request->company_logo_light)){
            $validated['company_logo_light'] = $this->storeImage($request->company_logo_light);
        }

        if(is_array($request->company_logo_dark)){
            $validated['company_logo_dark'] = $this->storeImage($request->company_logo_dark);
        }

        $this->settingRepository->update($validated);
        return Redirect::route('general-settings');
    }

    /**
     * Update the social media
     */
    public function socialMedia(SocialMediaRequest $request)
    {
        $this->settingRepository->update($request->validated());
        return Redirect::route('general-settings');
    }

    /**
     * Update the maintenance
     */
    public function maintenance(MaintenanceRequest $request)
    {
        $this->settingRepository->update($request->validated());
        return Redirect::route('general-settings');
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
            // Define the file extension based on the MIME type
            $mimeToExtension = [
                'image/jpeg' => 'jpeg',
                'image/png' => 'png',
                'image/gif' => 'gif'
            ];

            $extension = $mimeToExtension[$mimeType] ?? 'jpeg'; // Default to jpeg if MIME type is not recognized
            $filename = uniqid() . '.' . $extension;
            $path = 'logo/' . $filename;

            Log::debug("data", [ $path ]);
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
