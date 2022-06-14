<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function Products(){
        $products = Product::get()->toArray();
        // dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function UpdateProductStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    #Delete Product
    public function DeleteProduct($id){
        # Get Product image
        $proImage = Product::select('product_image')->where('id',$id)->first();
        # Eet image link
        $pro_image_path = 'admin/images/products_images/';
        # Delete Product_image from Product_image folder if exists
        if (!empty($proImage->product_image)) {
            unlink($pro_image_path.$proImage->product_image);
            Product::findOrFail($id)->delete();
            $message = "Product has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);  
        }else {
            Product::findOrFail($id)->delete();
            $message = "Product has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);    
        }  
    }
}
