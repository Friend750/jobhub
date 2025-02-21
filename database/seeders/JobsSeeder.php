<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use App\Models\JobPost;
// use App\Models\User;

// class JobsSeeder extends Seeder
// {
//     public function run()
//     {
//         // إنشاء 50 وظيفة باستخدام Factory
//         JobPost::factory(50)->create();
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPost;
use Illuminate\Support\Facades\DB;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_posts')->insert([
            'user_id' => 1,
            'job_title' => 'Software Developer',
            'about_job' => 'Develop and maintain software applications.',
            'job_tasks' => 'Write code, test applications, collaborate with team.',
            'job_conditions' => 'Full-time, remote work.',
            'job_skills' => 'JavaScript, PHP, Laravel, React',
            'job_location' => 'Remote',
            'job_timing' => 'Full-Time',
            'tags' => json_encode(['software', 'developer']),
            'target' => 'to_any_one',
            'is_active' => true,
            'job_post' => now(),
            'views' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
