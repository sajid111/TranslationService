<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Language;

    class LanguagesSeeder extends Seeder
    {
        public function run()
        {
            $languages = [
                ['code' => 'en', 'name' => 'English'],
                ['code' => 'fr', 'name' => 'French'],
                ['code' => 'es', 'name' => 'Spanish']
            ];

            foreach ($languages as $language) {
                Language::updateOrCreate(['code' => $language['code']], $language);
            }
        }
    }

?>
