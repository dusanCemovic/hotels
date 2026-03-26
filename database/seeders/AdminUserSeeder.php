<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'laravel@humanfrog.com'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('root'),
                'is_admin' => true,
                'email_verified_at' => Carbon::now(),
            ]
        );

        // Twill user
        DB::table('twill_users')->upsert(
            [[
                'email' => 'laravel@humanfrog.com',
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('root'),

                'role' => 'SUPERADMIN',
                'published' => 1,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'registered_at' => Carbon::now(),

                'require_new_password' => 0,
            ]],
            ['email'], // unique key
            [
                'name',
                'password',
                'role',
                'published',
                'updated_at'
            ]
        );
    }
}
