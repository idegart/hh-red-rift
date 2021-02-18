<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $data = parent::toArray($request);

        $this->whenLoaded('payload', function () use (&$data) {
            $data['payload'] = new PayloadResource($this->resource->payload);
        });

        return $data;
    }
}
