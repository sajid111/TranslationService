<?php
namespace Tests\Unit\TranslationService;

use Tests\TestCase;
use App\Models\Translation;
use App\Models\Language;
use App\Models\Tag;
use App\Services\TranslationService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class TranslationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $translationService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->translationService = app(TranslationService::class);
        $this->seed(DatabaseSeeder::class);
    }

    /** @test */
    /** @test */
    public function it_stores_translation_successfully()
    {
        $language = Language::inRandomOrder()->first();
        $tags = Tag::inRandomOrder()->limit(2)->pluck('id')->toArray();

        $data = [
            'key_name' => 'welcome_message',
            'language_id' => $language->id,
            'content' => 'Welcome to our website!',
            'tags' => $tags,
        ];

        $translation = $this->translationService->storeTranslation($data);

        $this->assertDatabaseHas('translations', [
            'key_name' => 'welcome_message',
            'language_id' => $language->id,
            'content' => 'Welcome to our website!',
        ]);

        $this->assertCount(count($tags), $translation->tags);

    }

    /** @test */
    public function it_updates_existing_translation()
    {
        $language = Language::inRandomOrder()->first() ;

        $translation = Translation::factory()->create();

        $tags = Tag::inRandomOrder()->limit(2)->pluck('id')->toArray();

        $updatedData = [
            'content' => 'New content',
            'tags' => $tags,
        ];

        $updatedTranslation = $this->translationService->updateTranslation($translation->id, $updatedData);

        $this->assertNotNull($updatedTranslation);

        $this->assertDatabaseHas('translations', [
            'id' => $translation->id,
            'content' => 'New content',
        ]);

        $this->assertCount(count($tags), $updatedTranslation->tags);

    }

    /** @test */
    public function it_returns_null_if_translation_not_found()
    {
        $nonExistingId = 999999;

        $updatedData = [
            'content' => 'New content',
            'tags' => [],
        ];

        $result = $this->translationService->updateTranslation($nonExistingId, $updatedData);

        $this->assertNull($result);
    }

}


?>
