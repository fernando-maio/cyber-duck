<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_company_returning_object_created()
    {
        $company = Company::factory()->make();
        $service = new CompanyService($company);

        $this->assertIsObject($service->create($company->toArray()));
    }

    public function test_get_by_an_inexistent_id()
    {
        $company = Company::factory()->make();
        $service = new CompanyService($company);

        $this->assertNull($service->getById(2021));
    }

    public function test_update_an_inexistent_company()
    {
        $company = Company::factory()->make();
        $service = new CompanyService($company);

        $this->assertFalse($service->update(2021, $company->toArray())['status']);
    }

    public function test_update_company()
    {
        $company = Company::factory()->make();
        $newCompany = Company::factory()->make();
        $company->save();
        $service = new CompanyService($company);

        $this->assertTrue($service->update($company->id, $newCompany->toArray())['status']);
    }

    public function test_remove_an_inexistent_company()
    {
        $company = Company::factory()->make();
        $service = new CompanyService($company);

        $this->assertFalse($service->delete(2021)['status']);
    }

    public function test_remove_company()
    {
        $company = Company::factory()->make();
        $company->save();
        $service = new CompanyService($company);

        $this->assertTrue($service->delete($company->id)['status']);
    }
}
