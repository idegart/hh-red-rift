<?php


namespace App\Services\Document;


use App\Contracts\DocumentStatusContract;
use App\Models\Document;
use Illuminate\Http\Request;

class PublishService
{
    public function publishByRequest(Request $request, Document $document): Document
    {
        $document->status = DocumentStatusContract::PUBLISHED;
        $document->save();

        return $document->fresh();
    }
}