<?php

namespace Database\Seeders;

use App\Models\JobPost;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    public function run(): void
    {
        JobPost::factory(50)->create(); // إنشاء 50 سجل وهمي

    }
}

