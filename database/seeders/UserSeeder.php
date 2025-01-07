<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'jroberts',
                'full_name' => 'James Roberts',
                'email_address' => 'jroberts@example.com',
                'password' => 'jroberts'
            ],
            [
                'username' => 'emartin',
                'full_name' => 'Emma Martin',
                'email_address' => 'emartin@example.com',
                'password' => 'emartin'
            ],
            [
                'username' => 'lthomas',
                'full_name' => 'Linda Thomas',
                'email_address' => 'lthomas@example.com',
                'password' => 'lthomas'
            ],
            [
                'username' => 'kjohnson',
                'full_name' => 'Kelly Johnson',
                'email_address' => 'kjohnson@example.com',
                'password' => 'kjohnson'
            ],
        ];


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        foreach ($users as $key => $user) {
            $user['role_id'] = $key + 1;
            User::create($user);
        }
    }
}
