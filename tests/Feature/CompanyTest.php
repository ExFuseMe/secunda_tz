<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CompanyTest extends TestCase
{

    public function testGetItems()
    {
        $token = Config::get('access.apiKey');

        $response = $this->withHeader('Authorization', $token)
            ->getJson('/api/v1/companies');

        dd($response->json());
    }
}
