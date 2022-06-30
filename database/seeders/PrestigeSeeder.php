<?php

namespace Database\Seeders;

use App\Models\Prestige;
use Illuminate\Database\Seeder;

class PrestigeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prestige::factory()
            ->count(5)
            ->create();
    }
}
