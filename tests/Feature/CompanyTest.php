<?php

namespace Tests\Feature;

use App\Models\Building;
use App\Models\Company;
use App\Models\Operation;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CompanyTest extends TestCase
{

    public function testGetItems()
    {
        $token = Config::get('access.apiKey');

        $response = $this->withHeader('Authorization', $token)
            ->getJson('/api/v1/companies');

        $response->assertStatus(200);
    }


    public function testGetItem()
    {
        $company = Company::factory()->create();
        $token = Config::get('access.apiKey');

        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies/$company->id");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'operation' => [
                    'id',
                    'tree'
                ],
                'phones',
                'building' => [
                    'id',
                    'name',
                    'latitude',
                    'longitude',
                ]
            ]
        ]);
    }

    public function testFilterByBuildingName()
    {
        $buildingName = Building::all()->random()->name;

        $token = Config::get('access.apiKey');

        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies?buildingName=$buildingName");

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }

    public function testFilterByOperationName()
    {
        $operationName = Operation::all()->random()->name;

        $token = Config::get('access.apiKey');
        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies?operationName=$operationName");

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }

    public function testFilterByArea()
    {
        $building = Building::all()->random();
        [$latitude, $longitude] = [$building->latitude, $building->longitude];
        $radius = random_int(10, 100);

        $token = Config::get('access.apiKey');
        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies?area[point][latitude]=$latitude&area[point][longitude]=$longitude&area[point][radius]=$radius");

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }

    public function testFilterByPoints()
    {
        $building = Building::all()->random();
        $point1 = [$building->latitude - random_int(1, 100), $building->longitude - random_int(1, 100)];
        $point2 = [$building->latitude + random_int(1, 100), $building->longitude + random_int(1, 100)];

        $token = Config::get('access.apiKey');
        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies?areaBox[point1][latitude]=$point1[0]&areaBox[point1][longitude]=$point1[1]&areaBox[point2][latitude]=$point2[0]&areaBox[point2][longitude]=$point2[1]");

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }

    public function testFilterByOperationChildren()
    {
        $operationName = Operation::all()->random()->name;

        $token = Config::get('access.apiKey');
        $response = $this->withHeader('Authorization', $token)
            ->getJson("/api/v1/companies?operationChildren=$operationName");
        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('data'));
    }
}
