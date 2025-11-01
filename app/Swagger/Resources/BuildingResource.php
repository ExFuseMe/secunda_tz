<?php

namespace App\Swagger\Resources;

/**
 * @OA\Schema(
 *     schema="BuildingResource",
 *     title="Building Resource",
 *     description="Building resource schema"
 * )
 */
class BuildingResource
{
    /**
     * @OA\Property(
     *     property="id",
     *     type="integer",
     *     example=1
     * )
     */
    public int $id;

    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     example="Main Building"
     * )
     */
    public string $name;

    /**
     * @OA\Property(
     *     property="latitude",
     *     type="number",
     *     format="float",
     *     example=55.7402
     * )
     */
    public float $latitude;

    /**
     * @OA\Property(
     *     property="longitude",
     *     type="number",
     *     format="float",
     *     example=49.1221
     * )
     */
    public float $longitude;
}
