<?php

namespace Database\Seeders;

use App\Models\Operation;
use Illuminate\Database\Seeder;

class OperationSeeder extends Seeder
{
    public function run(): void
    {
        // сделал так, чтобы был parentId
        for ($i = 0; $i < 10; $i++) {
            Operation::factory()->create();
        }
    }
}
