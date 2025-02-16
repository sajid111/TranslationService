<?php
    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class TranslationResource extends JsonResource
    {

        public function toArray($request)
        {

            return [
                'id' => $this->id,
                'key_name' => $this->key_name,
                'content' => $this->content,
                'language' => new LanguageResource($this->language),
                'tags' => TagResource::collection($this->tags),
            ];
        }
    }

?>
