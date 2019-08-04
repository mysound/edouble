<?php

namespace App\Imports;

use App\Product;
use App\Brand;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Intervention\Image\Facades\Image as ImageInt;
use Storage;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($skutitle) 
    {
        $this->skutitle = $skutitle;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function model(array $row)
    {
        $upc = $row['upc'];
        if(strlen($upc) < 13) {
           $upc = (strlen($upc) < 12) ? '00'.$upc : '0'.$upc;
        }

        $sku = $this->skutitle.'-'.$upc;

        $product = Product::where('sku', $sku)->first();

        if($product) {
            $product->quantity = $row['quantity'];
            $product->price = $this->price($row['price']);
            if(!$product->images->first()) {
                if (isset($row['image'])) {
                    $headers = get_headers($row['image']);
                    if (str_contains($headers[0], '200')) {
                        $imagetitle = substr($product->name, 0, 1).$product->upc.'.jpg';
                        $picture = ImageInt::make($row['image'])
                            ->resize(500, null, function ($constraint) { $constraint->aspectRatio(); } )
                            ->encode('jpg',100);
                        $thumbnail = ImageInt::make($row['image'])
                            ->resize(170, null, function ($constraint) { $constraint->aspectRatio(); } )
                            ->encode('jpg',100);
                        Storage::disk('images')->put($imagetitle, $picture);
                        Storage::disk('thumbnails')->put($imagetitle, $thumbnail);
                        $picture->destroy();
                        $thumbnail->destroy();
                        $product->images()->create([
                            'title' => $imagetitle
                        ]);
                    }
                }
            }
        } else {
            $product = new Product(
                [
                    'upc'   => $upc,            
                    'category_id' => $row['category'],
                    'sku' => $sku,
                    'name' => $row['artist'],
                    'title' => $row['title'],
                    'brand_id' => $this->brand($row['label']),
                    'short_description' => $row['short'],
                    'slug' => $row['artist'].'-'.$upc,
                    'price' => $this->price($row['price']),
                    'quantity' => $row['quantity'],
                    'description' => $row['description'],
                    'release_date' => $this->transformDate($row['date'])
                ]
            );
        }
        
        

        return $product;
    }

    public function chunkSize(): int
    {
        return 3000;
    }

    public function brand($value)
    {
        $brand = Brand::firstOrCreate(['title' => $value]);

        return $brand->id;
    }

    public function price($cost)
    {
        $price = 0;
        switch ($cost):
        case (($cost >= 0) and ($cost <= 3.99)):
            $price = ($cost + 4)*2;
            break;
        case (($cost >= 4) and ($cost <= 5.99)):
            $price = ($cost + 3)*2;
            break;
        case (($cost >= 6) and ($cost <= 9.99)):
            $price = ($cost + 2)*2;
            break;
        case (($cost >= 10) and ($cost <= 11.99)):
            $price = ($cost + 1)*2;
            break;
        case (($cost >= 12) and ($cost <= 13.99)):
            $price = $cost*2;
            break;
        case (($cost >= 12) and ($cost <= 13.99)):
            $price = $cost*2;
            break;
        case (($cost >= 14) and ($cost <= 15.99)):
            $price = $cost/100*90;
            $price = $price+$cost;
            break;
        case (($cost >= 16) and ($cost <= 19.99)):
            $price = $cost/100*80;
            $price = $price+$cost;
            break;
        case (($cost >= 20) and ($cost <= 22.99)):
            $price = $cost/100*70;
            $price = $price+$cost;
            break;
        case (($cost >= 23) and ($cost <= 28.99)):
            $price = $cost/100*60;
            $price = $price+$cost;
            break;
         case ($cost >= 29):
            $price = $cost/100*50;
            $price = $price+$cost;
            break;
        endswitch;

        return $price;
    }
}
