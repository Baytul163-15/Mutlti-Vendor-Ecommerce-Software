<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product_attribute;

class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributeRecords = [
            ['id'=>1,'product_id'=>1,'size'=>'small','price'=>100,'stock'=>10,'sku'=>'RC100-S','status'=>1],
            ['id'=>2,'product_id'=>2,'size'=>'medium','price'=>200,'stock'=>50,'sku'=>'RCC100-S','status'=>1],
            ['id'=>3,'product_id'=>5,'size'=>'large','price'=>300,'stock'=>100,'sku'=>'RCCC100-S','status'=>1],
        ];
        Product_attribute::insert($productAttributeRecords);
    }
}
