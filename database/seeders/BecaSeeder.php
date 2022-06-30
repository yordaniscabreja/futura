<?php

namespace Database\Seeders;

use App\Models\Beca;
use Illuminate\Database\Seeder;

class BecaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Beca::factory()
            ->count(5)
            ->create();
    }
}
