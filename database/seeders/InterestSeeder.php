<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            'Marketing',
            'Technology',
            'Economy',
            'Business',
            'Administration',
            'E-commerce',
            'IT Management',
            'Software Development',
            'Web Development',
            'Mobile Development',
            'Data Science',
            'Artificial Intelligence',
            'Cybersecurity',
            'Game Development',
        ];

        foreach ($interests as $interest) {
            Interest::create(['name' => $interest]);
        }
    }
}
