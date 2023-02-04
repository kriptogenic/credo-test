<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gift_money')->insert([
            'amount' => 10_000_000,
            'balance' => 10_000_000,
        ]);

        DB::table('gift_items')->insert([
            [
                'name' => 'Холодильник',
                'amount' => 10,
                'random_rate' => 25
            ],
            [
                'name' => 'Телевизор',
                'amount' => 10,
                'random_rate' => 30
            ],
            [
                'name' => 'Путевка в Дубай',
                'amount' => 2,
                'random_rate' => 10
            ],
            [
                'name' => 'Iphone 14 Pro',
                'amount' => 5,
                'random_rate' => 15
            ],
            [
                'name' => 'Футболка с мерчем',
                'amount' => 50,
                'random_rate' => 50
            ],
        ]);
    }
}
