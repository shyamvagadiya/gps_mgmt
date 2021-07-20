<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $fillable=['*']; 
    public function company()
    {
    	return $this->belongsTo(Company::class,'company_id');
    }
    public function type()
    {
    	return $this->belongsTo(Type::class,'type_id');	
    }
    public function application()
    {
    	return $this->belongsTo(Application::class,'application_id');		
    }
}
