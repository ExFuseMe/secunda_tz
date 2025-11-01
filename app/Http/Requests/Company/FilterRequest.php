<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "buildingName" => ["nullable", "string"],
            'operationName' => ["nullable", "string"],
            'area' => ["nullable", 'array'],
            'area.point.latitude' => ["nullable", 'numeric', 'required_with:area',],
            'area.point.longitude' => ["nullable", 'numeric', 'required_with:area',],
            'area.point.radius' => ["nullable", 'numeric', 'required_with:area',],
            'areaBox' => ["nullable", 'array'],
            'areaBox.point1.latitude' => ["nullable", 'numeric', 'required_with:areaBox',],
            'areaBox.point1.longitude' => ["nullable", 'numeric', 'required_with:areaBox',],
            'areaBox.point2.latitude' => ["nullable", 'numeric', 'required_with:areaBox',],
            'areaBox.point2.longitude' => ["nullable", 'numeric', 'required_with:areaBox',],
            'operationChildren' => ["nullable", 'string'],
        ];
    }
}
