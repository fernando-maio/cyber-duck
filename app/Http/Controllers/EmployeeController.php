<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CompanyServiceInterface;
use App\Contracts\Services\EmployeeServiceInterface;
use Illuminate\Http\Request;
use App\Helpers\Validations;

class EmployeeController extends Controller
{
    const PAGINATION = 10;

    /** @var EmployeeService $employeeService */
    private $employeeService;
    
    /** @var CompanyService $companyService */
    private $companyService;

    /**
     * Constructor.
     * 
     * @param EmployeeServiceInterface $employeeServiceInterface
     * @param CompanyServiceInterface $companyServiceInterface
     */
    public function __construct(EmployeeServiceInterface $employeeServiceInterface, CompanyServiceInterface $companyServiceInterface)
    {
        $this->employeeService = $employeeServiceInterface;
        $this->companyService = $companyServiceInterface;
    }

    /**
     * List Employees.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employeeList = $this->employeeService->list();
        $employees = $employeeList->paginate(self::PAGINATION);

        return view('pages.employees.index', array('employees' => $employees));
    }

    /**
     * Get create employee.
     * 
     * @return Response
     */
    public function getCreate()
    {
        $companies = $this->companyService->list()->get();
        return view('pages.employees.create', array('companies' => $companies));
    }

    /**
     * Post create employee.
     * Validate data with mandatory requests.
     *
     * @param  Request  $request
     * 
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $data = $request->all();
        $validation = Validations::employeeValidation($data);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
        
        if($this->employeeService->create($data))
            return redirect()->route("employees")->with('status', 'Employee created with success!');
        
        return redirect()->back()->withErrors('Error to create employee. Please, try again!')->withInput();
    }

    /**
     * Get data employee.
     * 
     * @param int $id employee ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employeeService->getById($id);
        $companies = $this->companyService->list()->get();

        if(!$employee)
            return redirect()->route("employees")->withErrors('Employee not found!');
        
        return view('pages.employees.edit', array('employee' => $employee, 'companies' => $companies));
    }

    /**
     * Update employee.
     * Validate data with mandatory requests.
     *
     * @param int $id employee id 
     * @param Request $request
     * 
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $validation = Validations::employeeValidation($data);
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
        
        $response = $this->employeeService->update($id, $data);
        if($response['status'])
            return redirect()->route("employees")->with('status', $response['msg']);
        
        return redirect()->back()->withErrors($response['msg'])->withInput();
    }

    /**
     * Remove employee.
     * 
     * @param int $id employee ID 
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $response = $this->employeeService->delete($id);
        if($response['status'])
            return redirect()->route("employees")->with('status', $response['msg']);

        return redirect()->back()->withErrors($response['msg']);
    }
}
