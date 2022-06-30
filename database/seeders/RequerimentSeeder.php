<?php

namespace Database\Seeders;

use App\Models\Requeriment;
use Illuminate\Database\Seeder;

class RequerimentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requeriment::factory()
            ->count(5)
            ->create();
    }
}
