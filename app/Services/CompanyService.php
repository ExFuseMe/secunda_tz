<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    public function __construct(protected CompanyRepository $repository)
    {
    }

    public function listCompanies(array $filterFields)
    {
        return $this->repository->ListFilteredCompanies($filterFields);
    }

    public function showCompany(int $id)
    {
        return $this->repository->getCompanyById($id);
    }
}
