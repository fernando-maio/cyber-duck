<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'company_id', 
        'email',
        'phone'
    ];

    /**
     * Company relation
     */
    public function company()
    {
    	return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
