<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Internalization;

class InternalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Internalization::factory()
            ->count(5)
            ->create();
    }
}
