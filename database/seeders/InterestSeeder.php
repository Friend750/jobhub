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
        // List of interests
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

        // Define which interests should be categorized as Business
        $businessRelated = [
            'Marketing',
            'Economy',
            'Business',
            'Administration',
            'E-commerce',
            'IT Management',
        ];

        // Define which interests should be categorized as Technology
        $techRelated = [
            'Technology',
            'Software Development',
            'Web Development',
            'Mobile Development',
            'Data Science',
            'Artificial Intelligence',
            'Cybersecurity',
            'Game Development',
        ];

        // For each interest, determine its type and insert into DB
        foreach ($interests as $interest) {
            $type = 'Other'; // default

            if (in_array($interest, $businessRelated)) {
                $type = 'Business';
            } elseif (in_array($interest, $techRelated)) {
                $type = 'Technology';
            }

            Interest::create([
                'name' => $interest,
                'type' => $type,
            ]);
        }
    }
}
