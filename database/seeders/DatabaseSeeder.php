<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // insert admin user for filament and for twill cms
        // insert rooms
        $this->call([
            AdminUserSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
