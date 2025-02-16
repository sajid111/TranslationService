<?php

    namespace App\Http\Requests;
    use App\Http\Requests\ApiRequest;

    class StoreTranslationRequest extends ApiRequest
    {
        public function authorize()
        {
            return true;
        }

        public function rules()
        {
            return [
                'key_name' => 'required|string|max:255',
                'language_id' => 'required|exists:languages,id',
                'content' => 'required|string',
                'tags' => 'nullable|array',
                'tags.*' => 'exists:tags,id',
            ];
        }
    }

?>
