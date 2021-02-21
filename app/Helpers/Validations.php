<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Validations
{
    /**
     * Validate company data. It's used to create and update actions
     * 
     * @param array $data
     * 
     * @return Validator
     */
    public static function companyValidation($data)
    {
        $rules = array(
            'name' => 'required|min:3',
            'logo' => 'dimensions:min_width=100,min_height=100'
        );

        $messages = array(
	    	'name.required' => 'Insert name',
	    	'name.min' => 'The name must have at least 3 characters',
	    	'logo.dimensions' => 'The image must have at least 100x100px'
        );
        
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Validate employee data. It's used to create and update actions
     * 
     * @param array $data
     * 
     * @return Validator
     */
    public static function employeeValidation($data)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required'
        );

        $messages = array(
	    	'first_name.required' => 'Insert first name',
	    	'last_name.required' => 'Insert last name',
	    	'company_id.required' => 'Select a company'
        );
        
        return Validator::make($data, $rules, $messages);
    }
}