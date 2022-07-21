<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product_attribute;
use App\Models\ProductMultiImage;
use Session;
use Auth;
use Image;

class ProductController extends Controller
{
    public function Products(){
        Session::put('page','products');
        $products = Product::with(['section'=>function($query){
            $query->select('id','section_name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
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
        # Get image link
        $large_iamge_path = 'admin/images/products_images/large_image/'; 
        $medium_iamge_path = 'admin/images/products_images/medium_image/'; 
        $small_iamge_path = 'admin/images/products_images/small_image/'; 

        # Delete Product_image from Product_image folder if exists
        if (!empty($proImage->product_image)) {
            # Unlink product image from product_image folder if exists
            if (file_exists($large_iamge_path.$proImage->product_image)) {
                unlink($large_iamge_path.$proImage->product_image);
            }
            if (file_exists($medium_iamge_path.$proImage->product_image)) {
                unlink($medium_iamge_path.$proImage->product_image);
            }
            if (file_exists($small_iamge_path.$proImage->product_image)) {
                unlink($small_iamge_path.$proImage->product_image);
            }
            Product::findOrFail($id)->delete();
            $message = "Product has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);
        }else {
            Product::findOrFail($id)->delete();
            $message = "Product has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

    public function AddEditProduct(Request $request, $id=null){
        Session::put('page','products');
        if ($id=="") {
            $title = "Add Product";
            $product = new Product;
            $message = "Product added successfully!";
        }else{
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;

            $rules = [
                // 'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_name' => 'required',
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_price' => 'required|numeric',
                'product_selling' => 'required|numeric',
                'product_discount' => 'required',
                'product_size' => 'required',
                'product_slug' => 'required',
                'product_weight' => 'required',
                'meta_title' => 'required',
                // 'product_vedio' => 'required',
                // 'product_image' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                // 'meta_keybords' => 'required',
            ];

            $customMessage = [
                'product_name.required' => 'Product Name is Requried',
                // 'product_name.regex' => 'Valid product name is Requried',
                'category_id.required' => 'Category is Requried',
                'brand_id.required' => 'Brand is Requried',
                'product_code.required' => 'Product code is Requried',
                'product_color.required' => 'Product color is Requried',
                'product_price.required' => 'Product price is Requried',
                'product_selling.required' => 'Product selling is Requried',
                'product_discount.required' => 'Product discount is Requried',
                'product_size.required' => 'Product size is Requried',
                'product_slug.required' => 'Product slug is Exists',
                // 'product_slug.unique' => 'This slug is Exists',
                'product_weight.required' => 'Product weight is Requried',
                'meta_title.required' => 'Meta title is Requried',
                // 'product_vedio.required' => 'Product vedio is Requried',
                // 'product_image.required' => 'Product image is Requried',
                'meta_description.required' => 'Product description is Requried',
            ];

            $this->validate($request, $rules, $customMessage);

            # Upload Product Image
            if ($request->hasFile('product_image')) {
                $pdt_image = $request->file('product_image');
                if ($pdt_image->isValid()) {
                    $extension = $pdt_image->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension; 
                    # Generate Image Path
                    $large_iamge_path = 'admin/images/products_images/large_image/'.$imageName; 
                    $medium_iamge_path = 'admin/images/products_images/medium_image/'.$imageName; 
                    $small_iamge_path = 'admin/images/products_images/small_image/'.$imageName; 
                    # Upload The Large, Medium and Small Image After Resize
                    Image::make($pdt_image)->resize(1000,1000)->save($large_iamge_path);
                    Image::make($pdt_image)->resize(500,500)->save($medium_iamge_path);
                    Image::make($pdt_image)->resize(250,250)->save($small_iamge_path);
                    $product->product_image = $imageName;
                }
            }
            // else{
            //     $product->imageName = "";
            // }

            # Upload product vedio
            if ($request->hasFile('product_vedio')) {
                $video_temp = $request->file('product_vedio');
                if ($video_temp->isValid()) {
                    # Upload vedio in video folder
                    $extensions = $video_temp->getClientOriginalExtension();
                    $vedioName = rand(111,99999).'.'.$extensions;
                    $vedioPath = 'admin/vedio/products_vedio/';
                    $video_temp->move($vedioPath,$vedioName);
                    $product->product_vedio = $vedioName;
                }else{
                    $product->product_vedio = "";
                }
            }

            # Save product details in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];

            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;

            $product->admin_type = $adminType;
            $product->admin_id = $admin_id;
            if ($adminType=="vendor") {
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }

            if (empty($data['product_discount'])) {
                $data['product_discount'] = 0;
            }
            if (empty($data['product_weight'])) {
                $data['product_weight'] = 0;
            }

            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_selling = $data['product_selling'];
            $product->product_discount = $data['product_discount'];
            // $product->product_qty = $data['product_qty'];
            $product->product_size = $data['product_size'];
            $product->product_slug = $data['product_slug'];
            $product->product_weight = $data['product_weight'];
            $product->product_description = $data['product_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            // $product->$imageName;
            $product->vedioName;
            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = "No";
            }
            if (!empty($data['is_bestseller'])) {
                $product->is_bestseller = $data['is_bestseller'];
            }else{
                $product->is_bestseller = "No";
            }
            $product->status = 1;
            $product->save();
            return redirect('admin/products')->with('success_message', $message);
        }

        # Get Section with categories and subcategories [This with('categories')=> is come from Section Model ]
        $categories = Section::with('categories')->get()->toArray();
        // dd($categories);
        # Get All Brands
        $brands = Brand::where('status',1)->get()->toArray();

        return view('admin.products.product-add-edit')->with(compact('title','product','categories','brands'));
    }

    public function DeleteProductImage($id){
        # Get product image
        $productImage = Product::select('product_image')->where('id',$id)->first();
        # get image link
        $large_iamge_path = 'admin/images/products_images/large_image/'; 
        $medium_iamge_path = 'admin/images/products_images/medium_image/'; 
        $small_iamge_path = 'admin/images/products_images/small_image/'; 
        #Delete product image from product_image folder if exists
        if (file_exists($large_iamge_path.$productImage->product_image)) {
            unlink($large_iamge_path.$productImage->product_image);
        }
        if (file_exists($medium_iamge_path.$productImage->product_image)) {
            unlink($medium_iamge_path.$productImage->product_image);
        }
        if (file_exists($small_iamge_path.$productImage->product_image)) {
            unlink($small_iamge_path.$productImage->product_image);
        }

        # Delete product image from (products_image) => (small_image) folder
        Product::where('id',$id)->update(['product_image'=>'']);
        $message = "Product Image has been delected successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function DeleteProductVedio($id){
        # Get product vedio
        $productVedio = Product::select('product_vedio')->where('id',$id)->first();
        # get vedio link
        $product_vedio_path = 'admin/vedio/products_vedio/';
        #Delete product vedio from product_vedio folder if exists
        if (file_exists($product_vedio_path.$productVedio->product_vedio)) {
            unlink($product_vedio_path.$productVedio->product_vedio);
        }

        # Delete product vedio from (product_vedio) folder
        Product::where('id',$id)->update(['product_vedio'=>'']);
        $message = "Product vedio has been delected successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function AddProductAttributes(Request $request, $id){
        Session::put('page','products');
        $product = Product::select('id','product_name','product_code','product_color','product_price','product_selling','product_image')->with('attributes')->find($id);
        // $product = json_decode(json_encode($product),true);
        // dd($product);

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {

                    # Validation for product attribute SKU.
                    $skuCount = Product_attribute::where('sku', $value)->count();
                    if ($skuCount > 0) {
                        return redirect()->back()->with('error_message','SKU already exists! Please add another SKU!');
                    }

                    # Validation for product attribute size.
                    // $sizeCount = Product_attribute::where('size',$data['size'][$key])->count();
                    
                    // $sizeCount = Product_attribute::with('product')->where(['product_id'=>$id,'size',$data['size'][$key]])->count(); 
                    // if ($sizeCount > 0) {
                    //     return redirect()->back()->with('error_message','Size already exists! Please add another Size!');
                    // }

                    $attribute = new Product_attribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $value;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->status = 1;
                    $attribute->save();
                }
            }
            return redirect()->back()->with('success_message','Product attribute has been added successfully!');
        }
        return view('admin.attributes.add_edit_attributes')->with(compact('product'));
    }

    # admin/superadmin/vendor update all product attribute active status.
    public function UpdateAttributeStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Product_attribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function DeleteProductAttribute($id){
        Product_attribute::findOrFail($id)->delete();
        $message = "Product attribute has been deleted successfully!";
        return redirect()->back()->with('success_message', $message);  
    }

    public function UpdateAttribute(Request $request,$id){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            foreach ($data['attributeId'] as $key => $attribute) {
                if (!empty($attribute)) {
                    Product_attribute::where(['id'=>$data['attributeId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
            }
            return redirect()->back()->with('success_message','Product attribute has been updated successfully!');
        }
    }

    #
    public function AddProductMultipleImage(Request $request, $id){
        Session::put('page','products');
        $products = Product::select('id','product_name','product_code','product_color','product_price','product_selling','product_image')->with('multiimage')->find($id);
        // $products = json_decode(json_encode($products),true);
        // dd($products);
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if ($request->hasFile('multiple_image')) {
                $images = $request->file('multiple_image');
                // echo "<pre>"; print_r($images); die;
                foreach ($images as $key => $image) {
                    # Generate Temp Image
                    $image_temp = Image::make($image);
                    # Get Image name
                    $image_name = $image->getClientOriginalName(); 

                    $extension = $image->getClientOriginalExtension();
                    $imageName = $image_name.rand(111,99999).'.'.$extension; 
                    # Generate Image Path
                    $large_iamge_path = 'admin/images/products_images/large_image/'.$imageName; 
                    $medium_iamge_path = 'admin/images/products_images/medium_image/'.$imageName; 
                    $small_iamge_path = 'admin/images/products_images/small_image/'.$imageName; 
                    # Upload The Large, Medium and Small Image After Resize
                    Image::make($image_temp)->resize(1000,1000)->save($large_iamge_path);
                    Image::make($image_temp)->resize(500,500)->save($medium_iamge_path);
                    Image::make($image_temp)->resize(250,250)->save($small_iamge_path);

                    $image = new ProductMultiImage;
                    $image->product_id = $id;
                    $image->multiple_image = $imageName;
                    $image->status = 1;
                    $image->save();
                }
            }
            return redirect()->back()->with('success_message','Product images has been updated successfully!');
        }
        return view('admin.multi_images.add_images')->with(compact('products'));
    }

    public function UpdateImagesStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            ProductMultiImage::where('id',$data['images_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'images_id'=>$data['images_id']]);
        }
    }

    public function DeleteMultiImage($id){
        # Get Product image
        $multiImage = ProductMultiImage::select('multiple_image')->where('id',$id)->first();
        # Get image link
        $large_iamge_path = 'admin/images/products_images/large_image/'; 
        $medium_iamge_path = 'admin/images/products_images/medium_image/'; 
        $small_iamge_path = 'admin/images/products_images/small_image/'; 

        # Delete multi_image from multi_image folder if exists
        if (!empty($multiImage->multiple_image)) {
            # Unlink multi_image image from Product_image folder if exists
            if (file_exists($large_iamge_path.$multiImage->multiple_image)) {
                unlink($large_iamge_path.$multiImage->multiple_image);
            }
            if (file_exists($medium_iamge_path.$multiImage->multiple_image)) {
                unlink($medium_iamge_path.$multiImage->multiple_image);
            }
            if (file_exists($small_iamge_path.$multiImage->multiple_image)) {
                unlink($small_iamge_path.$multiImage->multiple_image);
            }
            ProductMultiImage::findOrFail($id)->delete();
            $message = "Images has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);
        }else {
            ProductMultiImage::findOrFail($id)->delete();
            $message = "Images has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);
        }
    }

}
