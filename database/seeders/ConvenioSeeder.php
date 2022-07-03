<?php

namespace Database\Seeders;

use App\Models\Convenio;
use Illuminate\Database\Seeder;

class ConvenioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convenio::factory()
            ->count(5)
            ->create();
    }
}
