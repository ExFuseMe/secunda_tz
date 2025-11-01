<?php

namespace App\Repositories;

use App\Http\Filters\CompanyFilter;
use App\Models\Company as Model;

class CompanyRepository extends CoreRepository
{

    protected function getModelInstance(): string
    {
        return Model::class;
    }

    private function getRelations(array $relations = []): array
    {
        return !empty($relations) ? $relations : ['building', 'operation', 'phones'];
    }

    public function ListFilteredCompanies(array $filterFields)
    {
        $filter = app()->make(CompanyFilter::class, ['queryParams' => array_filter($filterFields)]);

        return $this->startConditions()
            ->filter($filter)
            ->with($this->getRelations())
            ->get();
    }

    public function getCompanyById(int $id)
    {
        return $this->startConditions()
            ->where('id', $id)
            ->with($this->getRelations())
            ->first();
    }
}
