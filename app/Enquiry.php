<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    public function company()
    {
    	return $this->belongsTo(Company::class,'company_id');
    }
}
