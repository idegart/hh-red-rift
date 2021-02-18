<?php

namespace App\Services\Document;

use App\Models\Document;
use App\Models\Payload;
use Illuminate\Foundation\Http\FormRequest;

class UpdateService
{
    protected Document $document;

    public function updateByRequest(FormRequest $request, Document $document): Document
    {
        $this->document = $document;

        $validatedData = $request->validated();

        if (array_key_exists('payload', $validatedData)) {
            $this->updatePayload($validatedData['payload']);
        }

        return $this->document->fresh();
    }

    protected function updatePayload(array $data): void
    {
        /** @var Payload $payload */
        $payload = $this->document->payload()->firstOrCreate();

        if (array_key_exists('actor', $data)) {
            $payload->actor = $data['actor'];
        }

        if (array_key_exists('meta', $data)) {
            $this->updatePayloadMeta($payload, $data['meta']);
        }

        if (array_key_exists('actions', $data)) {
            $this->updatePayloadActions($payload, $data['actions']);
        }

        $payload->save();
    }

    protected function updatePayloadMeta(Payload $payload, array $data): void
    {
        $payload->meta()->updateOrCreate($data);
    }

    protected function updatePayloadActions(Payload $payload, array $data): void
    {
        $payload->actions()->delete();
        $payload->actions()->createMany($data);
    }
}