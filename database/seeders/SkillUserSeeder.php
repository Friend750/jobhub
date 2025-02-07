<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $skills = Skill::pluck('id')->toArray();

        foreach ($users->where('type', 'user') as $user) {
            // Assign 5 to 15 random skills per user
            $randomSkills = collect($skills)->random(rand(5, 15));
            $user->skills()->syncWithoutDetaching($randomSkills);
        }
    }
}
