<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'logo', 
        'website'
    ];

    /**
     * Employee relation.
     */
    public function employee()
    {
    	return $this->hasMany('App\Models\Employee', 'company_id');
    }
}
