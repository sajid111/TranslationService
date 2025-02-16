<?php
    namespace App\Services;

    use App\Models\Translation;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Redis;

    class TranslationService
    {
        public function getTranslations(array $filters = [])
        {
            try {

                $cacheKey = 'translations:' . md5(json_encode($filters));

                return Cache::remember($cacheKey, 3600, function () use ($filters){

                    $query = Translation::with(['language', 'tags']);

                    if (!empty($filters['key_name'])) {
                        $query->where('key_name', 'LIKE', "%{$filters['key_name']}%");
                    }

                    if (!empty($filters['language_id'])) {
                        $query->where('language_id', $filters['language_id']);
                    }

                    if (!empty($filters['tags'])) {
                        $query->whereHas('tags', function ($q) use ($filters) {
                            $q->whereIn('name', $filters['tags']);
                        });
                    }

                    return $query->paginate(25);

                });

            } catch (\Throwable $th) {
                throw $th;
            }

        }

        public function showTranslation($id)
        {
            try {
                $translation = Translation::with(['language', 'tags'])->find($id);

                if (!$translation) {
                    return null;
                }

                return $translation;

            } catch (\Throwable $th) {
                throw $th;
            }

        }

        public function storeTranslation(array $data)
        {
            try {

                return DB::transaction(function () use ($data) {

                    $translation = Translation::updateOrCreate(
                        [
                            'key_name' => $data['key_name'],
                            'language_id' => $data['language_id'],
                        ],
                        [
                            'content' => $data['content'],
                        ]
                    );

                    if (!empty($data['tags'])) {

                        $translation->tags()->sync($data['tags']);

                    }
                    $this->clearCache();
                    return $translation;

                });

            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }

        }

        public function updateTranslation($id, array $data)
        {
            try {

                $translation = Translation::find($id);

                if (!$translation) {
                    return null;
                }

                $translation->update($data);

                if (!empty($data['tags'])) {
                    $translation->tags()->sync($data['tags']);
                }
                $this->clearCache();
                return $translation;

            } catch (\Throwable $th) {

                throw $th;
            }

        }

        public function clearCache()
        {
            try {
                Cache::flush();
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

?>
