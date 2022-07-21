<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    #This function goto ProductController => (AddProductAttributes) function.
    public function attributes(){
        return $this->hasMany('App\Models\Product_attribute');
    }

    #This function goto ProductController => (AddProductMultipleImage) function.
    public function multiimage(){
        return $this->hasMany('App\Models\ProductMultiImage');
    }

    public static function getDiscountPrice($product_id){
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first();
        $proDetails = json_decode(json_encode($proDetails), true);

        $catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first();
        $catDetails = json_decode(json_encode($catDetails), true);

        if ($proDetails['product_price'] > 0) {
            # code...
            $discount_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['product_discount']/100);
        }else if ($catDetails['category_discount'] > 0) {
            # code...
            $discount_price = $proDetails['product_price'] - ($proDetails['product_price'] * $proDetails['category_discount']/100);
        }else{
            $discount_price = 0;
        }
        return $discount_price;
    }
}
