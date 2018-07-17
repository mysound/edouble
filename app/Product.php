<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;

class Product extends Model
{
	protected $fillable = ['category_id', 'sku', 'title', 'name', 'brand_id', 'ganre_id',  'slug', 'short_description', 'description', 'price', 'upc', 'quantity', 'release_date', 'availability', 'published', 'new_product', 'meta_title', 'meta_description', 'meta_keyword', 'created_by', 'modified_by'];

	public function setSlugAttribute($value)
	{
		$this->attributes['slug'] = Str::slug(mb_substr($this->title."-".$this->name."-".$this->upc, 0, 40) . "-" . \Carbon\Carbon::now()->format('mdyHi'), '-');
	}

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function ganre()
    {
        return $this->belongsTo(Ganre::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    /**
     * Get all of the product's images.
     * Polymorphic Relations
     */
    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function addImage($files)
    {
        $i = 0;
        foreach ($files as $file) {
            $imagetitle = str_slug($this->title . ' ' . $this->name . ' ' . time(), '-') . $i++ . '.' . $file->getClientOriginalExtension();
            $picture = ImageInt::make($file)
                ->resize(500, null, function ($constraint) { $constraint->aspectRatio(); } )
                ->encode('jpg',100);
            Storage::disk('images')->put($imagetitle, $picture);
            $picture->destroy();
            $this->images()->create([
                'title' => $imagetitle
            ]);
        }
    }

    public function deleteImage()
    {
        foreach ($this->images as $image) {
            Storage::disk('images')->delete($image->title);
            $image->delete();
        }
    }
}
