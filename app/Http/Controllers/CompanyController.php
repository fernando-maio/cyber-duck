<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CompanyServiceInterface;
use Illuminate\Http\Request;
use App\Helpers\Validations;

class CompanyController extends Controller
{
    const PAGINATION = 10;
    private $companyService;

    /**
     * Constructor
     * 
     * @param CompanyServiceInterface $companyServiceInterface
     */
    public function __construct(CompanyServiceInterface $companyServiceInterface)
    {
        $this->companyService = $companyServiceInterface;
    }
    
    /**
     * List Companies.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyList = $this->companyService->list();
        $companies = $companyList->paginate(self::PAGINATION);

        return view('pages.companies.index', array('companies' => $companies));
    }

    /**
     * Get create company
     * 
     * @return Response
     */
    public function getCreate()
    {
        return view('pages.companies.create');
    }

    /**
     * Post create company
     *
     * @param  Request  $request
     * 
     * @return Response
     */
    public function postCreate(Request $request)
    {
        $data = $request->all();
        $validation = Validations::companyValidation($data);
        
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }
        
        if($this->companyService->create($data))
            return redirect()->route("companies")->with('status', 'Company created with success!');
        
        return redirect()->back()->withErrors('Error to create company. Please, try again!')->withInput();
    }

    /**
     * Get data company.
     * 
     * @param int $id company ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = $this->companyService->getById($id);
        
        return view('pages.companies.edit', array('company' => $company));
    }

    /**
     * Update company
     *
     * @param int $id company id 
     * @param Request $request
     * 
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $validation = Validations::companyValidation($data);
        if (!$validation->passes()) {
            return redirect()
            ->back()
            ->withErrors($validation)
            ->withInput();
        }

        $response = $this->companyService->update($id, $data);
        if($response['status'])
            return redirect()->route("companies")->with('status', $response['msg']);
        
        return redirect()->back()->withErrors($response['msg'])->withInput();
    }

    /**
     * Remove company.
     * 
     * @param int $id company ID 
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $response = $this->companyService->delete($id);

        if($response['status'])
            return redirect()->route("companies")->with('status', $response['msg']);

        return redirect()->back()->withErrors($response['msg']);
    }
}
