<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function client()
    {
    	return $this->belongsTo(Client::class,'client_id');
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
