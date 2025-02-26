<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPost;
use App\Models\User; // أضف هذا الاستيراد

class JobsSeeder extends Seeder
{
    public function run()
    {
        JobPost::factory(50)->create();

      
    }
}