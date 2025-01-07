<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::truncate();
        Settings::insert([
            [
                'field_name' => 'company_logo_light',
                'value' => null,
            ],
            [
                'field_name' => 'company_logo_dark',
                'value' => null
            ],
            [
                'field_name' => 'facebook',
                'value' => "https://www.facebook.com/olivia.j"
            ],
            [
                'field_name' => 'instagram',
                'value' => "https://www.instagram.com/olivia.j"
            ],
            [
                'field_name' => 'x',
                'value' => "https://www.x.com/olivia.j"
            ],
            [
                'field_name' => 'tiktok',
                'value' => "https://www.tiktok.com/olivia.j"
            ],
            [
                'field_name' => 'company_name',
                'value' => "Olivia J"
            ],
            [
                'field_name' => 'company_email_address',
                'value' => "olivia.j@yahoo.com"
            ],
            [
                'field_name' => 'contact_number',
                'value' => "+1-555-123-4567"
            ],
            [
                'field_name' => 'description',
                'value' => "Discover quality products and exceptional service at Olivia J. We are committed to bringing you the best in fashion industry. Explore our range and experience excellence with every purchase."
            ],
            [
                'field_name' => 'enable_maintenance',
                'value' => true
            ],
            [
                'field_name' => 'maintenance_mode_message',
                'value' => `Our website is temporarily down for scheduled maintenance. We’re working hard to bring you a better experience. Please check back shortly.`],
            [
                'field_name' => 'maintenance_start_date',
                'value' => null
            ],
            [
                'field_name' => 'maintenance_start_time',
                'value' => null
            ],
            [
                'field_name' => 'affected_platform',
                'value' => null
            ]
        ]);
    }
}
