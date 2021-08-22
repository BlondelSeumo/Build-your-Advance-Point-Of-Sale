<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Language::count() === 0) {
            Language::create(
                [
                    'locale' => 'en',
                    'name' => 'English',
                ]
            );
        }
    }
}
