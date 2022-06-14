<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            ['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'Men','category_image'=>'','category_discount'=>0,'category_description'=>'Salesforce B2C Commerce can help you create unified','url'=>'men','meta_title'=>'','meta_description'=>'','meta_keybords'=>'','status'=>1],
            ['id'=>2,'parent_id'=>0,'section_id'=>1,'category_name'=>'Women','category_image'=>'','category_discount'=>0,'category_description'=>'Salesforce B2C Commerce can help you create unified','url'=>'women','meta_title'=>'','meta_description'=>'','meta_keybords'=>'','status'=>1],
            ['id'=>3,'parent_id'=>0,'section_id'=>1,'category_name'=>'Kids','category_image'=>'','category_discount'=>0,'category_description'=>'Salesforce B2C Commerce can help you create unified','url'=>'kids','meta_title'=>'','meta_description'=>'','meta_keybords'=>'','status'=>1],
        ];
        Category::insert($categoryRecords);
    }
}
