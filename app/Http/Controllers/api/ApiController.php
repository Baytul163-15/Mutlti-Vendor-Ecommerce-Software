<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;

class ApiController extends Controller
{
    public function AllBrand(){
        $brand = Brand::where('status',1)->latest()->paginate(3);
        // $brand = Brand::where('status',1)->latest()->get();
        return response()->json($brand);
    }
}
