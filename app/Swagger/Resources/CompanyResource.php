<?php

namespace App\Swagger\Resources;

/**
 * @OA\Schema(
 *     schema="CompanyResource",
 *     title="Company Resource",
 *     description="Company resource schema"
 * )
 */
class CompanyResource
{
    /**
     * @OA\Property(property="id", type="integer", example=1)
     */
    public int $id;

    /**
     * @OA\Property(property="name", type="string", example="KFU Company")
     */
    public string $name;

    /**
     * @OA\Property(
     *     property="operation",
     *     type="object",
     *     ref="#/components/schemas/OperationResource"
     * )
     */
    public object $operation;

    /**
     * @OA\Property(
     *     property="phones",
     *     type="array",
     *     @OA\Items(type="string", example="+7 (999) 123-45-67")
     * )
     */
    public array $phones;

    /**
     * @OA\Property(
     *     property="building",
     *     type="object",
     *     ref="#/components/schemas/BuildingResource"
     * )
     */
    public object $building;
}
