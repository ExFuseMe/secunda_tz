<?php

namespace App\Swagger\Resources;
/**
 * @OA\Schema(
 *     schema="OperationResource",
 *     title="Operatioт Resource",
 *     description="Operation resource schema"
 * )
 */
class OperationResource
{
    /**
     * @OA\Property (type="integer")
     */
    public int $id;
    /**
     * @OA\Property (
     *     type="array",
     *     @OA\Items(type="string")
     * )
     */
    public array $tree;
}
