<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(100)->create();
        $this->call(SkillSeeder::class);
        $this->call(InterestSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(JobsSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(ExperienceSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(PersonalDetailSeeder::class);

        $this->call(SkillUserSeeder::class);
    }
}
