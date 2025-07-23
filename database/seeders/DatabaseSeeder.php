<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // I used here for my testing purpose.
        User::firstOrCreate(
            ['email' => 'test@example.com'], 
            [
                'name' => 'Test User',
                'password' => bcrypt('secret@123'),
            ]
        );

        $this->call([
            AgeLoadSeeder::class,
            CurrencySeeder::class,
        ]);
    }
}
