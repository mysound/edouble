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

    public function __construct($skuTitle = '', $year = '', $month = '')
    {
        $this->skuTitle = $skuTitle;
        $this->year = $year;
        $this->month = $month;
    }
    
    public function query()
    {
        return Product::query()
            ->where('sku', 'like', $this->skuTitle.'%')
            ->whereYear('release_date', '=', $this->year)
            ->whereMonth('release_date', '=', $this->month);
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
