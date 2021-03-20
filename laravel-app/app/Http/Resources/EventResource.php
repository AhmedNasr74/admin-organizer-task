<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at->format("d-m-Y H:i"),
            'organizer' => [
                'id' => $this->resource->organizer->id,
                'name' => $this->resource->organizer->name,
            ]
        ];
    }
}
