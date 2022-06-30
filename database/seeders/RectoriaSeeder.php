<?php

namespace Database\Seeders;

use App\Models\Rectoria;
use Illuminate\Database\Seeder;

class RectoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rectoria::factory()
            ->count(5)
            ->create();
    }
}
