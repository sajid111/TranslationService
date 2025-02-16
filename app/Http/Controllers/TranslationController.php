<?php

namespace App\Http\Controllers;

use App\Http\BaseClasses\ApiResponse;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Requests\UpdateTranslationRequest;
use App\Http\Resources\TranslationResource;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Exception;

class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function index(): JsonResponse
    {
        try {

            $translations = $this->translationService->getTranslations(request()->all());
            return ApiResponse::success(TranslationResource::collection($translations), 'Translations retrieved successfully');

        } catch (Exception $e) {
            return ApiResponse::error('Failed to retrieve translations', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function store(StoreTranslationRequest $request): JsonResponse
    {
        try {

            $translation = $this->translationService->storeTranslation($request->validated());
            return ApiResponse::success(new TranslationResource($translation), 'Translation stored successfully', 200);

        } catch (Exception $e) {
            return ApiResponse::error('Failed to store translation', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function update(UpdateTranslationRequest $request, $id): JsonResponse
    {
        try {

            $translation = $this->translationService->updateTranslation($id, $request->validated());

            if (!$translation) {
                return ApiResponse::error('Translation not found', 404);
            }

            return ApiResponse::success(new TranslationResource($translation), 'Translation updated successfully');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to update translation', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function show($id): JsonResponse
    {
        try {

            $translation = $this->translationService->showTranslation($id);

            if (!$translation) {
                return ApiResponse::error('Translation not found', 404);
            }

            return ApiResponse::success(new TranslationResource($translation), 'Translation fetched successfully');
        } catch (Exception $e) {
            return ApiResponse::error('Failed to fetch translation', 500, ['exception' => $e->getMessage()]);
        }
    }



}
