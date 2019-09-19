<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ItemsExport implements FromQuery, WithHeadings, WithMapping
{
   use Exportable;

    public function __construct($skuTitle = '', int $year = 2019, int $month = 01)
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

    public function map($row): array
    {
    	$title = $row->name.' - '.$row->title.' () New';

        $image = '';
        if($row->images->first()) {
            $image = 'https://dbsides.com/storage/images/'.$row->images->first()->title;
        }


        $globalShipping = '1';
        if($row['price'] >= 40) {
            $globalShipping = '0';
        } else {
            $globalShipping = '1';
        }
        return [
            $row->id,
            $row->category_id,
            $row->upc,
            $title,
            $row->description,
            '1000',
            $image,
            '1',
            'FixedPrice',
            $row->price,
            'GTC',
            '11235',
            '1',
            'skovyla@yahoo.com',
            'Flat',
            'USPSMedia',
            '0.00',
            $globalShipping,
            '15',
            $row->sku,
            'ReturnsAccepted',
            'Buyer',
        ];
    }

    public function headings(): array
    {
        return [
            '*Action(SiteID=US|Country=US|Currency=USD|Version=941)',
            '*Category',
            'Product:UPC',
            'Title',
            'Description',
            '*ConditionID',
            'PicURL',
            '*Quantity',
            '*Format',
            '*StartPrice',
            '*Duration',
            '*Location',
            'PayPalAccepted',
            'PayPalEmailAddress',
            'ShippingType',
            'ShippingService-1:Option',
            'ShippingService-1:Cost',
            'GlobalShipping',
            'DispatchTimeMax',
            'CustomLabel',
            'ReturnsAcceptedOption',
            'ShippingCostPaidByOption'
        ];
    }
}
