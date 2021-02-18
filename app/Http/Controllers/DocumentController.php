<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\{IndexRequest, PublishRequest, StoreRequest, UpdateRequest};
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\Document\{CreateService, PublishService, UpdateService};
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResource
     */
    public function index(IndexRequest $request): JsonResource
    {
        return DocumentResource::collection(
            Document::query()
                ->paginate(
                    $request->perPage()
                )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param CreateService $createService
     * @return JsonResource
     */
    public function store(StoreRequest $request, CreateService $createService): JsonResource
    {
        return new DocumentResource(
            $createService->createFromRequest(
                $request
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return Response
     */
    public function show(Document $document): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Document $document
     * @param UpdateService $updateService
     * @return JsonResource
     */
    public function update(UpdateRequest $request, Document $document, UpdateService $updateService): JsonResource
    {
        return new DocumentResource(
            $updateService->updateByRequest(
                $request,
                $document
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return Response
     */
    public function destroy(Document $document): Response
    {
        //
    }

    /**
     * @param PublishRequest $request
     * @param Document $document
     * @param PublishService $publishService
     * @return JsonResource
     */
    public function publish(PublishRequest $request, Document $document, PublishService $publishService): JsonResource
    {
        return new DocumentResource(
            $publishService->publishByRequest(
                $request,
                $document
            )
        );
    }
}
