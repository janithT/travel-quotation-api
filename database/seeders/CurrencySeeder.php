<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curencies = [
            ['currency_id' => 'USD', 'fixed_rate' => 3.0],
            ['currency_id' => 'EUR', 'fixed_rate' => 3.0],
            ['currency_id' => 'GBP', 'fixed_rate' => 3.0],

        ];

        foreach ($curencies as $curency) {
            DB::table('currencies')->updateOrInsert(
                [
                    'currency_id' => $curency['currency_id'],
                    'fixed_rate' => $curency['fixed_rate'],
                ],
            );
        }
    }
}
