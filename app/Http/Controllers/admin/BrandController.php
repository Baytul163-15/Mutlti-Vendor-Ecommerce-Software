<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Session;
use Image;

class BrandController extends Controller
{
    public function Brands(){
        Session::put('page','brands');
        $brands = Brand::get()->toArray();
        // dd($brands);
        return view('admin.brand.brands')->with(compact('brands'));
    }

    # admin/superadmin update all vendor active status.
    public function UpdateBrandStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

    #Edit Brands
    public function AddEditBrand(Request $request,$id=null){
        Session::put('page','brands');
        if ($id=="") {
            $title = "Add Brand";
            $brand = new Brand;
            $message = "Brand added successfully!";
        }else{
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = "Brand updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];

            $customMessage = [
                'brand_name.required' => 'Section Name is Requried',
                'brand_name.regex' => 'Valid Section Name is Requried',
            ];

            $this->validate($request, $rules, $customMessage);

            #Upload Brand Image
            if ($request->hasFile('brand_image')) {
                $brd_image = $request->file('brand_image');
                if ($brd_image->isValid()) {
                    $extension = $brd_image->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension; 
                    $iamge_path = 'admin/images/brand_image/'.$imageName; 
                    Image::make($brd_image)->save($iamge_path);
                    $brand->brand_image = $imageName;
                }
            }else{
                $brand->imageName = "";
            }
            
            $brand->brand_name = $data['brand_name'];
            $brand->$imageName;
            $brand->status = 1;
            $brand->save();
            // dd($brand);
            return redirect('admin/brands')->with('success_message',$message);
        }

        return view('admin.brand.brand_add_edit')->with(compact('title','brand','message'));
    }

    public function DeleteBrandImage($id){
        # Get Brand image
        $brandImage = Brand::select('brand_image')->where('id',$id)->first();
        # Eet image link
        $brand_image_path = 'admin/images/brand_image/';
        # Delete Brand_image from Brand_image folder if exists
        if (file_exists($brand_image_path.$brandImage->brand_image)) {
            unlink($brand_image_path.$brandImage->brand_image);
        }

        # Delete Brand_image from Brands folder
        Brand::where('id',$id)->update(['brand_image'=>'']);
        $message = "Brand Image has been delected successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function DeleteBrand($id){
        # Get Brand image
        $brandImage = Brand::select('brand_image')->where('id',$id)->first();
        # Eet image link
        $brand_image_path = 'admin/images/brand_image/';
        # Delete Brand_image from Brand_image folder if exists
        if (!empty($brandImage->brand_image)) {
            unlink($brand_image_path.$brandImage->brand_image);
            Brand::findOrFail($id)->delete();
            $message = "Brand has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);  
        }else {
            Brand::findOrFail($id)->delete();
            $message = "Brand has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);    
        }  
    }

    // public function DeleteBrand($id){
    //     $brand = Brand::findOrFail($id);
    //     $img = $brand->brand_image;
    //     $brand_image_path = 'admin/images/brand_image/';
    //     unlink($brand_image_path.$img);
    //     Brand::findOrFail($id)->delete();
    //     $message = "Brand has been deleted successfully!";
    //     return redirect()->back()->with('success_message', $message);
    // }
}
