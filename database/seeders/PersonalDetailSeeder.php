<?php

namespace Database\Seeders;

use App\Models\PersonalDetail;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalDetail::factory(100)->create();
    }
}
