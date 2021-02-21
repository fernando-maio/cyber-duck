<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_employee_returning_object_created()
    {
        $company = Company::factory()->make();
        $company->save();
        
        $employee = Employee::factory()->make();
        $employee->company_id = $company->id;
        $service = new EmployeeService($employee);

        $this->assertIsObject($service->create($employee->toArray()));
    }

    public function test_get_by_an_inexistent_id()
    {
        $employee = Employee::factory()->make();
        $service = new EmployeeService($employee);

        $this->assertNull($service->getById(2021));
    }

    public function test_update_an_inexistent_employee()
    {
        $employee = Employee::factory()->make();
        $service = new EmployeeService($employee);

        $this->assertFalse($service->update(2021, $employee->toArray())['status']);
    }

    public function test_update_employee()
    {
        $company = Company::factory()->make();
        $company->save();

        $employee = Employee::factory()->make();
        $newemployee = Employee::factory()->make();
        $employee->company_id = $company->id;
        $employee->save();
        $service = new EmployeeService($employee);

        $this->assertTrue($service->update($employee->id, $newemployee->toArray())['status']);
    }

    public function test_remove_an_inexistent_employee()
    {
        $employee = Employee::factory()->make();
        $service = new EmployeeService($employee);

        $this->assertFalse($service->delete(2021)['status']);
    }

    public function test_remove_employee()
    {
        $company = Company::factory()->make();
        $company->save();

        $employee = Employee::factory()->make();
        $employee->company_id = $company->id;
        $employee->save();
        $service = new EmployeeService($employee);

        $this->assertTrue($service->delete($employee->id)['status']);
    }
}
