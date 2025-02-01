<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPost;
use App\Models\User;

class JobsSeeder extends Seeder
{
    public function run()
    {
        // إنشاء 50 وظيفة باستخدام Factory
        JobPost::factory(50)->create();
    }
}
