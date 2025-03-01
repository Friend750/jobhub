<?php
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
        JobPost::factory(50)->create(); // إنشاء 50 سجل وهمي

      
    }
}
