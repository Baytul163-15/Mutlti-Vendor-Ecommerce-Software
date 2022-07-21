<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;

class FrontendController extends Controller
{
    public function HomePage(){
        $slidersBanner = Slider::where('type','slider')->where('status',1)->get()->toArray();
        $fixBanner = Slider::where('type','fix')->where('status',1)->get()->toArray();
        // dd($fixBanner);
        $newProducts = Product::orderBy('id','desc')->where('status',1)->limit(8)->get()->toArray();
        // dd($newProduct);
        $bestSeller = Product::where(['is_bestseller'=>'Yes', 'status'=>1])->inRandomOrder()->get()->toArray();
        // dd($bestSeller);
        return view('frontend.index_frontend')->with(compact('slidersBanner','fixBanner','newProducts','bestSeller'));
    }
}
