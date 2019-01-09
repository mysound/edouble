<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;

class Slide extends Model
{
    protected $fillable = ['title', 'product_id'];

    public function images()
    {
    	return $this->morphMany('App\Image', 'imageable');
    }

    public function addImage($file) {
        $imagetitle = str_slug($this->title . ' ' . time(), '-') . '.' . $file->getClientOriginalExtension();
        $picture = ImageInt::make($file)
            ->resize(455, 236, function ($constraint) { $constraint->aspectRatio(); } )
            ->encode('jpg',100);
        Storage::disk('images')->put($imagetitle, $picture);
        $picture->destroy();
        $this->images()->create([
            'title' => $imagetitle
        ]);
    }

    public function deleteImage()
    {
        foreach ($this->images as $image) {
            Storage::disk('images')->delete($image->title);
            $image->delete();
        }
    }
}
