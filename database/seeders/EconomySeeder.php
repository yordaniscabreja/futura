<?php

namespace Database\Seeders;

use App\Models\Economy;
use Illuminate\Database\Seeder;

class EconomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Economy::factory()
            ->count(5)
            ->create();
    }
}
