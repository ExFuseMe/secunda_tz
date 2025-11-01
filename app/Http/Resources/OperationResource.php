<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $operationTree = $this->resource->getOperationsByLevel();

        return [
            'id' => $this->resource->id,
            'tree' => $operationTree,
        ];
    }
}
