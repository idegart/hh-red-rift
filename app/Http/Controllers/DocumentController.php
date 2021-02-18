<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Document\{IndexRequest, PublishRequest, StoreRequest, UpdateRequest};
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use App\Services\Document\{CreateService, PublishService, UpdateService};
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('token')->only('store', 'update', 'publish');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResource|View
     */
    public function index(IndexRequest $request)
    {
        $documents = Document::query()
            ->paginate(
                $request->perPage()
            );

        if ($request->expectsJson()) {
            return DocumentResource::collection($documents);
        }

        return view('pages.documents.index', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param CreateService $createService
     * @return RedirectResponse|JsonResource
     */
    public function store(StoreRequest $request, CreateService $createService)
    {
        $document = $createService->createFromRequest($request);

        if ($request->wantsJson()) {
            return new DocumentResource($document);
        }

        return redirect(route('documents.show', compact('document')));
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return View
     */
    public function show(Document $document): View
    {
        return view('pages.documents.show', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Document $document
     * @param UpdateService $updateService
     * @return JsonResource|RedirectResponse
     */
    public function update(UpdateRequest $request, Document $document, UpdateService $updateService)
    {
        $document = $updateService->updateByRequest($request, $document);

        if ($request->wantsJson()) {
            return new DocumentResource($document);
        }

        return redirect(route('documents.show', compact('document')));
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
     * @return JsonResource|RedirectResponse
     */
    public function publish(PublishRequest $request, Document $document, PublishService $publishService)
    {
        $document = $publishService->publishByRequest($request, $document);

        if ($request->expectsJson()) {
            return new DocumentResource($document);
        }

        return redirect(route('documents.show', compact('document')));
    }
}
