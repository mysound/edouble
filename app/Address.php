<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'country_id', 'first_name', 'last_name', 'address', 'state', 'city', 'zip_code', 'phone', 'comment'];
}
