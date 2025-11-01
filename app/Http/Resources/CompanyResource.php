<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'operation' => new OperationResource($this->resource->operation),
            'phones' => $this->resource->phones->pluck('value'),
            'building' => new BuildingResource($this->resource->building),
        ];
    }
}
