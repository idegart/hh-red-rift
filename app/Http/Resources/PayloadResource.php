<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PayloadResource extends JsonResource
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

        $this->whenLoaded('meta', function () use (&$data) {
            $data['meta'] = new MetaResource($this->resource->meta);
        });

        $this->whenLoaded('actions', function () use (&$data) {
            $data['actions'] = ActionResource::collection($this->resource->actions);
        });

        return $data;
    }
}
