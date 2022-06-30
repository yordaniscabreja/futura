<?php

namespace Database\Seeders;

use App\Models\Academy;
use Illuminate\Database\Seeder;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academy::factory()
            ->count(5)
            ->create();
    }
}
