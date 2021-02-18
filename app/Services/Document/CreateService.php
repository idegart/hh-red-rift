<?php

namespace App\Services\Document;

use App\Contracts\DocumentStatusContract;
use App\Models\Document;
use Illuminate\Http\Request;

class CreateService
{
    public function makeFromRequest(Request $request): Document
    {
        $document = new Document();

        $document->status = DocumentStatusContract::DRAFT;

        return $document;
    }

    public function createFromRequest(Request $request): Document
    {
        $document = $this->makeFromRequest($request);
        $document->save();

        return $document->fresh();
    }
}