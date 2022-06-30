<?php

namespace Database\Seeders;

use App\Models\LifeStyle;
use Illuminate\Database\Seeder;

class LifeStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LifeStyle::factory()
            ->count(5)
            ->create();
    }
}
