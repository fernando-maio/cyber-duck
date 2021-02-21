<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const PAGINATION = 10;
    private $employee;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employeeList = $this->employee->orderBy('first_name');
        $employees = $employeeList->paginate(self::PAGINATION);
        
        return view('dashboard', array('employees' => $employees));
    }
}
