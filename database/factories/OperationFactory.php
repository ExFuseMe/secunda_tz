<?php

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    public function definition(): array
    {
        $parentId = Operation::all()->count() === 0 ? null : Operation::all()->random()->id;

        return [
            'name' => $this->faker->word(),
            'parent_id' => $parentId,
        ];
    }
}
