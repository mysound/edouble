<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
	protected $fillable = ['category_id', 'title', 'name', 'brand_id', 'ganre_id',  'slug', 'short_description', 'description', 'image', 'price', 'upc', 'release_date', 'availability', 'published', 'new_product', 'meta_title', 'meta_description', 'meta_keyword', 'created_by', 'modified_by'];

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('mdyHi'), '-');
	}

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
