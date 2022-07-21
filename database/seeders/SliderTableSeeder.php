<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliderRecords = [
            ['id'=>1,'slider_image'=>'banner-1.png','link'=>'Spring-Collection','title'=>'Spring Collection','alt'=>'Spring Collection','status'=>1],
            ['id'=>2,'slider_image'=>'banner-2.png','link'=>'Summer-Collection','title'=>'Summer Collection','alt'=>'Summer Collection','status'=>1],
        ];
        Slider::insert($sliderRecords);
    }
}
