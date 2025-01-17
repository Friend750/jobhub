<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = 
        [
            "Arabic",
            "English",
            "French",
            "Turkish",
            "Chinese (Mandarin)",
            "Spanish",
            "German",
            "Russian",
            "Italian",
            "Persian (Farsi)",
            "Hindi",
            "Somali",
            "Amharic",
            "Urdu",
            "Swahili"
        ];

        foreach ($languages as $language) {
            Language::create(['language' => $language]);
        }
        
    }
}
