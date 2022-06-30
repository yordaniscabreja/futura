<?php

namespace Database\Seeders;

use App\Models\Wellness;
use Illuminate\Database\Seeder;

class WellnessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wellness::factory()
            ->count(5)
            ->create();
    }
}
