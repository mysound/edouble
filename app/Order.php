<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
    	return $this->belongsToMany('App\Product')->withPivot('quantity');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function address()
    {
    	return $this->belongsTo('App\Address');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
