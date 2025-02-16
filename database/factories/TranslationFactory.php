<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class TranslationFactory extends Factory
{
    protected $model = Translation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key_name' => 'key_' . Str::random(10),
            'language_id' => Language::inRandomOrder()->first(),
            'content' => $this->faker->sentence,
        ];
    }
}
