<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Session;
use Image;

class SliderController extends Controller
{
    public function SliderSection(){
        Session::put('page','sliders');
        $sliders = Slider::get()->toArray();
        return view('admin.slider.slider')->with(compact('sliders'));
    }

    public function AddEditSlider(Request $request,$id=null){
        $slider_id = $request->id;
        Session::put('page','sliders');
        if ($id=="") {
            $title = "Add Slider";
            $sliders = new Slider;
            $message = "Slider added successfully!";
        }else{
            $title = "Update Slider";
            $sliders = Slider::find($slider_id);
            $message = "Slider updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['type']=="slider") {
                $width = "1920";
                $height = "720";
            }else if ($data['type']=="fix") {
                $width = "1110";
                $height = "236";
            }

            #Upload Slider Image
            if ($request->hasFile('slider_image')) {
                $slide_image = $request->file('slider_image');
                if ($slide_image->isValid()) {
                    $extension = $slide_image->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension; 
                    $iamge_path = 'frontend/images/banners/'.$imageName; 
                    Image::make($slide_image)->resize($width,$height)->save($iamge_path);
                    $sliders->slider_image = $imageName;
                }
            }
            // else{
            //     $sliders->slider_image = "";
            // }
            
            $sliders->type = $data['type'];
            $sliders->link = $data['link'];
            $sliders->title = $data['title'];
            $sliders->alt = $data['alt'];
            // $sliders->$imageName;
            $sliders->status = 1;
            $sliders->save();

            return redirect('admin/slider')->with('success_message', $message);
        }
        return view('admin.slider.add_edit_slider')->with(compact('title','sliders'));
    }

    public function UpdateSliderStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status']=='Active') {
                $status = 0;
            }else{
                $status = 1;
            }
        }
        Slider::where('id',$data['slider_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status, 'slider_id'=>$data['slider_id']]);
    }

    public function DeleteSlider($id){
        # Get Brand image
        $sliderImage = Slider::select('slider_image')->where('id',$id)->first();
        # Eet image link
        $slider_image_path = 'frontend/images/banners/';
        # Delete Brand_image from Brand_image folder if exists
        if (!empty($sliderImage->slider_image)) {
            unlink($slider_image_path.$sliderImage->slider_image);
            Slider::findOrFail($id)->delete();
            $message = "Slider has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);  
        }else {
            Slider::findOrFail($id)->delete();
            $message = "Slider has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);    
        }
    }

    public function DeleteSliderImage($id){
        # Get Brand image
        $sliderImage = Slider::select('slider_image')->where('id',$id)->first();
        # Eet image link
        $slider_image_path = 'frontend/images/banners/';
        # Delete Brand_image from Brand_image folder if exists
        if (file_exists($slider_image_path.$sliderImage->slider_image)) {
            unlink($slider_image_path.$sliderImage->slider_image);
        }

        # Delete Brand_image from Brands folder
        Slider::where('id',$id)->update(['slider_image'=>'']);
        $message = "Slider Image has been delected successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
