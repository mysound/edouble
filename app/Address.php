<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'country_id', 'first_name', 'last_name', 'address', 'state_id', 'city', 'zip_code', 'phone'];

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }

    public function orders()
    {
    	return $this->hasMany('App\Order');
    }

    public function state()
    {
    	return $this->belongsTo('App\State');
    }
}
