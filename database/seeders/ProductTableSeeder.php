<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ProductRecords = [
            ['id'=>1,'section_id'=>2,'category_id'=>5,'brand_id'=>7,'vendor_id'=>1,'admin_id'=>0,'admin_type'=>'vendor','product_name'=>'Redmi Note 11','product_code'=>'RN121','product_price'=>12500,'product_selling'=>12300,'product_discount'=>10,'product_qty'=>50,'product_size'=>'small','product_slug'=>'redmi_note_11','product_weight'=>500,'product_image'=>'','product_vedio'=>'','meta_title'=>'redmi_note_11','meta_description'=>'redmi_note_11','meta_keywords'=>'redmi_note_11','is_featured'=>'Yes','status'=>1],

            ['id'=>2,'section_id'=>1,'category_id'=>4,'brand_id'=>6,'vendor_id'=>0,'admin_id'=>1,'admin_type'=>'vendor','product_name'=>'Lenevo 50 plus','product_code'=>'LM10','product_price'=>12500,'product_selling'=>12300,'product_discount'=>10,'product_qty'=>50,'product_size'=>'small','product_slug'=>'lenevo_50_plus','product_weight'=>500,'product_image'=>'','product_vedio'=>'','meta_title'=>'lenevo_50_plus','meta_description'=>'lenevo_50_plus','meta_keywords'=>'lenevo_50_plus','is_featured'=>'Yes','status'=>1],
        ];

        Product::insert($ProductRecords);
    }
}
