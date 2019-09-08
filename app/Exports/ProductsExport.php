<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, ShouldQueue, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($skuTitle)
    {
        $this->skuTitle = $skuTitle;
    }
    
    public function query()
    {
        return Product::query()->where('sku', 'like', $this->skuTitle.'%');
    }

    public function headings(): array
    {
        return [
            '#',
            '*Category',
            'SKU',
            'Name',
            'Title',
            'Brand',
            'Ganre',
            'Slug',
            'Short Description',
            'Description',
            'Price',
            'UPC',
            'Quantity',
            'Release Date',
            'Availability',
            'Publised',
            'New Product',
            'Meta Title',
            'Meta Description',
            'Meta Keyword',
            'Created By',
            'Modified By',
            'created_at',
            'updated_at',
        ];
    }
}
