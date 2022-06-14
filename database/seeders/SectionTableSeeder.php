<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            ['id'=>4, 'section_name'=>'Clothing', 'status'=>1],
            ['id'=>5, 'section_name'=>'Electronics', 'status'=>1],
            ['id'=>6, 'section_name'=>'Appliances', 'status'=>1],
            ['id'=>7, 'section_name'=>'Clothing', 'status'=>1],
            ['id'=>8, 'section_name'=>'Electronics', 'status'=>1],
            ['id'=>9, 'section_name'=>'Appliances', 'status'=>1],
            ['id'=>10, 'section_name'=>'Clothing', 'status'=>1],
            ['id'=>11, 'section_name'=>'Electronics', 'status'=>1],
            ['id'=>12, 'section_name'=>'Appliances', 'status'=>1],
            ['id'=>13, 'section_name'=>'Clothing', 'status'=>1],
            ['id'=>14, 'section_name'=>'Electronics', 'status'=>1],
        ];
        Section::insert($sectionRecords);
    }
}
