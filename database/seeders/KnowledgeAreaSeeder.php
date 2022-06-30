<?php

namespace Database\Seeders;

use App\Models\KnowledgeArea;
use Illuminate\Database\Seeder;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KnowledgeArea::factory()
            ->count(5)
            ->create();
    }
}
