<?php

namespace Database\Seeders;

use App\Models\BasicCore;
use Illuminate\Database\Seeder;

class BasicCoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BasicCore::factory()
            ->count(5)
            ->create();
    }
}
