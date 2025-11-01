<?php

namespace App\Http\Filters;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;

class CompanyFilter extends AbstractFilter
{
    public const BUILDING_NAME = 'buildingName';
    public const OPERATION_NAME = 'operationName';
    public const AREA = 'area';
    public const AREA_BOX = 'areaBox';
    public const OPERATION_CHILDREN = 'operationChildren';

    protected function getCallbacks(): array
    {
        return [
            self::BUILDING_NAME => [$this, 'collectByBuildingName'],
            self::OPERATION_NAME => [$this, 'collectByOperationName'],
            self::AREA => [$this, 'collectByArea'],
            self::AREA_BOX => [$this, 'collectByAreaBox'],
            self::OPERATION_CHILDREN => [$this, 'collectByOperationChildren'],
        ];
    }

    public function collectByBuildingName(Builder $builder, $value): Builder
    {
        return $builder->whereHas('building', function (Builder $query) use ($value) {
            $query->where('name', 'ilike', "%{$value}%");
        });
    }

    public function collectByOperationName(Builder $builder, $value): Builder
    {
        return $builder->whereHas('operation', function (Builder $query) use ($value) {
            $query->where('name', 'ilike', "%{$value}%");
        });
    }

    public function collectByArea(Builder $builder, $value): Builder
    {
        $latitude = $value['point']['latitude'];
        $longitude = $value['point']['longitude'];
        $radiusKm = $value['point']['radius'];

        // 1 градус = 111 км
        $radiusInDegrees = $radiusKm / 111;

        return $builder->whereHas('building', function (Builder $query) use ($latitude, $longitude, $radiusInDegrees) {
            $query->whereRaw("
            POW(latitude - ?, 2) + POW(longitude - ?, 2) <= POW(?, 2)
        ", [$latitude, $longitude, $radiusInDegrees]);
        });
    }

    public function collectByAreaBox(Builder $builder, $value): Builder
    {
        $lat1 = $value['point1']['latitude'];
        $lon1 = $value['point1']['longitude'];
        $lat2 = $value['point2']['latitude'];
        $lon2 = $value['point2']['longitude'];

        return $builder->whereHas('building', function (Builder $query) use ($lat1, $lat2, $lon1, $lon2) {
            $query
                ->whereBetween('latitude', [min($lat1, $lat2), max($lat1, $lat2)])
                ->whereBetween('longitude', [min($lon1, $lon2), max($lon1, $lon2)]);
        });
    }

    public function collectByOperationChildren(Builder $builder, $value): Builder
    {
        $operation = Operation::where('name', 'ilike', "%{$value}%")->first();

        if (!$operation) {
            return $builder;
        }

        $operationIds = $operation->getAllChildrenIds();

        return $builder->whereHas('operation', function (Builder $query) use ($operationIds) {
            $query->whereIn('id', $operationIds);
        });
    }

}
