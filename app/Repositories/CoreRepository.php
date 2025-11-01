<?php

namespace App\Repositories;

abstract class CoreRepository
{
    protected mixed $model;

    public function __construct(){
        $this->model = app($this->getModelInstance());
    }

    abstract protected function getModelInstance();

    protected function startConditions()
    {
        return clone $this->model;
    }
}
