<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'PHP',
            'Laravel',
            'JavaScript',
            'HTML',
            'CSS',
            'Python',
            'React',
            'Vue.js',
            'SQL',
            'Git',
            'Docker',
            'Node.js',
            'Bootstrap',
            'Tailwind CSS',
            'SASS',
            'LESS',
            'Angular',
            'TypeScript',
            'Next.js',
            'Gatsby',
            'WordPress',
            'Joomla',
            'Drupal',
        ];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
