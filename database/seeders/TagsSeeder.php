<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Tag;

    class TagsSeeder extends Seeder
    {
        public function run()
        {
            $tags = ['mobile', 'desktop', 'web'];

            foreach ($tags as $tag) {
                Tag::updateOrCreate(['name' => $tag]);
            }
        }
    }

?>
