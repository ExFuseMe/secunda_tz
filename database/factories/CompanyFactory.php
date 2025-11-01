<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'operation_id' => Operation::all()->random()->id,
            'building_id' => Building::all()->random()->id,
        ];
    }
}
