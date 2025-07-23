<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeLoadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $age_loads = [
            ['min_age' => 18, 'max_age' => 30, 'load' => 0.60],
            ['min_age' => 31, 'max_age' => 40, 'load' => 0.70],
            ['min_age' => 41, 'max_age' => 50, 'load' => 0.80],
            ['min_age' => 51, 'max_age' => 60, 'load' => 0.90],
            ['min_age' => 61, 'max_age' => 70, 'load' => 1.00],
        ];

        foreach ($age_loads as $age_load) {
            DB::table('ageloads')->updateOrInsert(
                [
                    'min_age' => $age_load['min_age'],
                    'max_age' => $age_load['max_age']
                ],
                ['load' => $age_load['load']]
            );
        }
    }
}
