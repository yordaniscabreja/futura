<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AcademicLevelSeeder::class);
        $this->call(AcademicProgramSeeder::class);
        $this->call(AcademySeeder::class);
        $this->call(AgreementSeeder::class);
        $this->call(BasicCoreSeeder::class);
        $this->call(BecaSeeder::class);
        $this->call(BenefitSeeder::class);
        $this->call(BondSeeder::class);
        $this->call(CampusSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EconomySeeder::class);
        $this->call(EducationLevelSeeder::class);
        $this->call(InternalizationSeeder::class);
        $this->call(KnowledgeAreaSeeder::class);
        $this->call(LifeStyleSeeder::class);
        $this->call(MediaSeeder::class);
        $this->call(MediaTypeSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(PrestigeSeeder::class);
        $this->call(RectoriaSeeder::class);
        $this->call(RequerimentSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WellnessSeeder::class);
        $this->call(ZoneSeeder::class);
    }
}
