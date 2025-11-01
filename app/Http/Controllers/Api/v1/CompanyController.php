<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\FilterRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    public function __construct(protected CompanyService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/companies",
     *     tags={"Companies"},
     *     summary="Проверка доступности API",
     *     description="Простой тестовый эндпоинт для проверки работы Swagger.",
     *     security={{"Authorization":{}}},
     *     @OA\Parameter(
     *          name="buildingName",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="operationName",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="operationChildren",
     *          in="query",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="area[point][latitude]",
     *          in="query",
     *          description="Широта точки центра области поиска (area)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="area[point][longitude]",
     *          in="query",
     *          description="Долгота точки центра области поиска (area)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="area[point][radius]",
     *          in="query",
     *          description="Радиус области поиска (км)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="areaBox[point1][latitude]",
     *          in="query",
     *          description="Широта первой точки прямоугольной области (areaBox)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="areaBox[point1][longitude]",
     *          in="query",
     *          description="Долгота первой точки прямоугольной области (areaBox)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="areaBox[point2][latitude]",
     *          in="query",
     *          description="Широта второй точки прямоугольной области (areaBox)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *      @OA\Parameter(
     *          name="areaBox[point2][longitude]",
     *          in="query",
     *          description="Долгота второй точки прямоугольной области (areaBox)",
     *          required=false,
     *          @OA\Schema(type="number", format="float")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Успешный ответ",
     *          @OA\JsonContent(ref="#/components/schemas/CompanyResource")
     *      )
     * )
     */
    public function index(FilterRequest $request)
    {
        $filterFields = $request->validated();

        $companies = $this->service->listCompanies($filterFields);

        return CompanyResource::collection($companies);
    }

    public function show(Company $company)
    {
        $company = $this->service->showCompany($company->id);

        return new CompanyResource($company);
    }
}
