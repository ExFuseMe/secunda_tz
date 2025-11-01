<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->phoneNumber(),
            'company_id' => Company::all()->random()->id,
        ];
    }
}
