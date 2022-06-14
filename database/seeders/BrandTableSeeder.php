<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecords = [
            ['id'=>1, 'brand_name'=>'Apple', 'status'=>1],
            ['id'=>2, 'brand_name'=>'Dell', 'status'=>1],
            ['id'=>3, 'brand_name'=>'Samsung', 'status'=>1],
            ['id'=>4, 'brand_name'=>'Nokia', 'status'=>1],
            ['id'=>5, 'brand_name'=>'Realmi', 'status'=>1],
            ['id'=>6, 'brand_name'=>'Acer', 'status'=>1],
            ['id'=>7, 'brand_name'=>'Logitec', 'status'=>1],
            ['id'=>8, 'brand_name'=>'Konka', 'status'=>1],
            ['id'=>9, 'brand_name'=>'Walton', 'status'=>1],
            ['id'=>10, 'brand_name'=>'Easy', 'status'=>1],
            ['id'=>11, 'brand_name'=>'Dorgibari', 'status'=>1],
        ];
        Brand::insert($brandRecords);
    }
}
