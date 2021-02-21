<?php

namespace App\Services;

use App\Contracts\Services\CompanyServiceInterface;
use App\Helpers\ImageManagement;
use App\Models\Company;

class CompanyService implements CompanyServiceInterface
{
    /** @var Company $company */
    private $company;

    /**
     * Constructor.
     * 
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * List companies ordered by name.
     * 
     * @return Response
     */
    public function list()
    {
        return $this->company->orderBy('name');
    }

    /**
     * Create company. 
     * Verify logo. If exists, call a ImageManagement helper to save it in storage.
     *
     * @param  array $data
     * 
     * @return Response
     */
    public function create(array $data)
    {
        if(!empty($data['logo'])){
            $imageManagement = new ImageManagement;
            $data['logo'] = $imageManagement->createImage($data['logo']);
        }

        return $this->company->create($data);
    }

    /**
     * Get company by ID.
     *
     * @param  int $id
     * 
     * @return Response
     */
    public function getById(int $id)
    {
        return $this->company->find($id);
    }

    /**
     * Update company.
     * If the company wasn't found, return an status error to Controller.
     * Verify new logo logo. If it's true, call a ImageManagement helper to save it in storage, removing the old one.
     *
     * @param  int $id
     * @param  array $data
     * 
     * @return array
     */
    public function update(int $id, array $data)
    {
        $company = $this->getById($id);
        if(empty($company)){
            return array(
                'status' => false,
                'msg' => 'Company not found.'
            );
        }
        
        if(!empty($data['logo'])){
            $imageManagement = new ImageManagement;
            $data['logo'] = $imageManagement->updateImage($company->logo, $data['logo']);
        }

        if($company->update($data)){
            return array(
                'status' => true,
                'msg' => 'Company updated with success!'
            );
        }

        return array(
            'status' => false,
            'msg' => 'Error to update company. Please, try again!'
        );
    }

    /**
     * Delete company.
     * If the company wasn't found, return an status error to Controller.
     * Check if the company has some employee attached. If it's true, return an status error to Controller.
     * After delete a company, remove the logo image from storage (If it exists).
     *
     * @param  int $id
     * 
     * @return array
     */
    public function delete(int $id)
    {
        $company = $this->getById($id);
        if(empty($company)){
            return array(
                'status' => false,
                'msg' => 'Company not found.'
            );
        }

        if(count($company->employee) > 0){
            return array(
                'status' => false,
                'msg' => 'You have employees associate with this company. Remove this association before.'
            );
        }

        $logo = $company->logo;
        $status = $company->delete();
        if($status){
            if(!empty($logo)){
                $imageManagement = new ImageManagement;
                $imageManagement->deleteImage($logo);
            }

            return array(
                'status' => true,
                'msg' => 'Company removed with success!'
            );
        }
        else{
            return array(
                'status' => false,
                'msg' => 'Error to remove company. Please, try again!'
            );
        } 
    }
}