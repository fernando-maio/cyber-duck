<?php

namespace App\Services;

use App\Contracts\Services\EmployeeServiceInterface;
use App\Models\Employee;

class EmployeeService implements EmployeeServiceInterface
{
    /** @var Employee $employee */
    private $employee;

    /**
     * Constructor.
     * 
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * List employees ordered by name.
     * 
     * @return Response
     */
    public function list()
    {
        return $this->employee->orderBy('first_name');
    }

    /**
     * Create Employee.
     *
     * @param  array $data
     * 
     * @return Response
     */
    public function create(array $data)
    {
        return $this->employee->create($data);
    }

    /**
     * Get Employee by ID.
     *
     * @param  int $id
     * 
     * @return Response
     */
    public function getById(int $id)
    {
        return $this->employee->find($id);
    }

    /**
     * Update employee.
     * If the employee wasn't found, return an status error to Controller.
     *
     * @param  int $id
     * @param  array $data
     * 
     * @return array
     */
    public function update(int $id, array $data)
    {
        $employee = $this->getById($id);
        if(empty($employee)){
            return array(
                'status' => false,
                'msg' => 'Employee not found.'
            );
        }

        if($employee->update($data)){
            return array(
                'status' => true,
                'msg' => 'Employee updated with success!'
            );
        }

        return array(
            'status' => false,
            'msg' => 'Error to update employee. Please, try again!'
        );
    }

    /**
     * Delete employee
     * If the employee wasn't found, return an status error to Controller.
     *
     * @param  int $id
     * 
     * @return array
     */
    public function delete(int $id)
    {
        $employee = $this->getById($id);
        if(empty($employee)){
            return array(
                'status' => false,
                'msg' => 'Employee not found.'
            );
        }

        $status = $employee->delete();
        if($status){
            return array(
                'status' => true,
                'msg' => 'Employee removed with success!'
            );
        }
        else{
            return array(
                'status' => false,
                'msg' => 'Error to remove employee. Please, try again!'
            );
        } 
    }
}