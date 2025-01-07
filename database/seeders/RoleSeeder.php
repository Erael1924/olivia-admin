<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                "role_name" => "Super Administrator",
                "slug" => "super-administrator",
                "description" =>
                    "Has full access to all system features and administrative capabilities.",
            ],
            [
                "role_name" => "Customer Support",
                "slug" => "customer-support",
                "description" =>
                    "Handles customer inquiries, issues, and support requests.",
            ],
            [
                "role_name" => "Marketing",
                "slug" => "marketing",
                "description" =>
                    "Responsible for promoting products and services, and managing marketing campaigns.",
            ],
            [
                "role_name" => "Sales",
                "slug" => "sales",
                "description" =>
                    "Focuses on generating leads, closing sales, and maintaining client relationships.",
            ],

        ];

        Roles::truncate();
        foreach ($roles as $role) {
            Roles::create($role);
        }
    }
}
