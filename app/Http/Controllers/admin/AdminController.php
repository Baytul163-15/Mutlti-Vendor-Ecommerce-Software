<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\vendor_business_details;
use App\Models\vendor_bank_details;
use App\Models\apps_countries;
use Image;
use Session;

class AdminController extends Controller
{

    # Admin Login (if match email and password and status is 1 then login with Superadmin/admin)
    public function AdminLogin(Request $request){
        if ($request->isMethod('post')) {
            $post = $request->all();
            //echo "<pre>"; print_r($post); die;
            
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessage = [
                'email.required' => 'Email Address is Requried !',
                'email.email' => 'Valid Email Address id Requried',
                'password.required' => 'Password is Requried'
            ];

            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('admin')->attempt(['email'=>$post['email'],'password'=>$post['password'],'status'=>1])) {
                return redirect('admin/dashboard');
            }else{
                return redirect()->back()->with('error_message','Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    # Admin/Vendor/User: Panel or Dashboard 
    public function AdminDashboard(){
        Session::put('page','admin_master');
        return view('admin.index');
    }

    # Update password for superadmin/admin 
    public function UpdateSuperadminPassword(Request $request){
        Session::put('page','update_admin_password');

        // echo "<pre>"; print_r(Auth::guard('admin')->user()); die;

        if ($request->isMethod('post')) {
            $data = $request->all();    

            // echo "<pre>"; print_r($data); die;
            if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
                
                if ($data['confirm_password']==$data['new_password']) {
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_msg','Your password updated successfully !');
                }else{
                    return redirect()->back()->with('error_msg','Your confirm password and new password not match !');        
                }        

            }else{
                return redirect()->back()->with('error_msg','Your typing password is incorrect !');
            }
        }
        $amdinDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('amdinDetails'));
    }

    # Check old password then update current password for superadmin/admin
    public function CheckCurrentPassword(Request $request){
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
            return "true";
        }else{
            return "false";
        }
    }

    # Update superadmin/admin information/Details
    public function UpdateSuperadminPersonalDetails(Request $request){
        Session::put('page','update_admin_details');

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $rules = [
                'admin_email' => 'email|unique:users,email',
                'admin_type' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_number' => 'required|numeric',
            ];

            $customMessage = [
                'admin_type.required' => 'Type is Requried',
                'admin_type.regex' => 'Valid Type is Requried',
                'admin_name.required' => 'Name is Requried',
                'admin_name.regex' => 'Valid name is Requried',
                'admin_number.required' => 'Mobile naumber is Requried',
                'admin_number.numeric' => 'Vaild Mobile naumber is Requried'
            ];

            $this->validate($request, $rules, $customMessage);

            //Upload Image
            // $imageName = '';
            if ($request->hasFile('admin_image')) {
                // $image_temp = $request->file('admin_image'); 
                $ser_image = $request->file('admin_image');
                if ($ser_image->isValid()) {
                    // $extension = $image_temp->getClientOriginalExtension();
                    // $imageName = rand(111,99999).'.'.$extension; 
                    // $iamge_path = 'admin/images/adminImage/'.$imageName; 
                    // Image::make($image_temp)->save($iamge_path);
                    $name_gen = hexdec(uniqid());
                    $img_ext = strtolower($ser_image->getClientOriginalExtension());
                    $img_name = $name_gen.'.'.$img_ext;
                    $up_location = 'admin/images/adminImage/';
                    $last_img = $up_location.$img_name;
                    $ser_image->move($up_location,$img_name);
                }
            }else if (!empty($data['current_admin_image'])) {
                $img_name = $data['current_admin_image'];
            }else{
                $img_name = "";
            }

           
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['email'=>$data['admin_email'], 'type'=>$data['admin_type'], 'name'=>$data['admin_name'], 'mobile'=>$data['admin_number'], 'image'=>$img_name ]);
            return redirect()->back()->with('success_msg', 'Admin details updated successfully !!');
        }
        return view('admin.settings.update_admin_details');
    }

    # Update Vendor Personal/Business/Bank Information
    public function UpdateVendorDetails($slug, Request $request){
        if ($slug=="personal") {
            Session::put('page','update_personal_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'vendor_email' => 'email|unique:users,email',
                    'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_address' => 'required',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_pincode' => 'required',
                    'vendor_number' => 'required|numeric',
                ];
    
                $customMessage = [
                    'vendor_name.required' => 'Name is Requried',
                    'vendor_name.regex' => 'Valid Name is Requried',
                    'vendor_address.required' => 'Address is Requried',
                    'vendor_city.required' => 'City is Requried',
                    'vendor_city.regex' => 'Valid City is Requried',
                    'vendor_state.required' => 'State is Requried',
                    'vendor_state.regex' => 'Valid State is Requried',
                    'vendor_country.required' => 'Country is Requried',
                    'vendor_country.regex' => 'Valid Country is Requried',
                    'vendor_pincode.required' => 'Pincode naumber is Requried',
                    'vendor_number.required' => 'Mobile naumber is Requried',
                    'vendor_number.numeric' => 'Vaild Mobile naumber is Requried'
                ];
    
                $this->validate($request, $rules, $customMessage);
    
                //Upload Image
                // $imageName = '';
                if ($request->hasFile('vendor_image')) {
                    // $image_temp = $request->file('admin_image'); 
                    $save_image = $request->file('vendor_image');
                    if ($save_image->isValid()) {
                        // $extension = $image_temp->getClientOriginalExtension();
                        // $imageName = rand(111,99999).'.'.$extension; 
                        // $iamge_path = 'admin/images/adminImage/'.$imageName; 
                        // Image::make($image_temp)->save($iamge_path);
                        $name_gen = hexdec(uniqid());
                        $img_ext = strtolower($save_image->getClientOriginalExtension());
                        $image_name = $name_gen.'.'.$img_ext;
                        $up_location = 'admin/images/vendorImage/';
                        $last_img = $up_location.$image_name;
                        $save_image->move($up_location,$image_name);
                    }
                }else if (!empty($data['current_vendor_image'])) {
                    $image_name = $data['current_vendor_image'];
                }else{
                    $image_name = "";
                }
    
               #Update Admin Table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['email'=>$data['vendor_email'], 'name'=>$data['vendor_name'], 'mobile'=>$data['vendor_number'], 'image'=>$image_name ]);

                #Update Admin Table
                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(['name'=>$data['vendor_name'], 'address'=>$data['vendor_address'], 'email'=>$data['vendor_email'], 'city'=>$data['vendor_city'], 'state'=>$data['vendor_state'], 'country'=>$data['vendor_country'], 'pincode'=>$data['vendor_pincode'], 'mobile'=>$data['vendor_number'], 'image'=>$image_name ]);    

                return redirect()->back()->with('success_msg', 'Vendor details updated successfully !!');
            }
            $vendorDetails = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if ($slug=="business") {
            Session::put('page','update_business_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'shop_email' => 'email|unique:users,email',
                    'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_address' => 'required',
                    'address_proof' => 'required',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_state' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_country' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_pincode' => 'required',
                    'shop_mobile' => 'required|numeric',
                    'shop_website' => 'required',
                    'business_license_number' => 'required',
                    'gst_number' => 'required',
                    'pan_number' => 'required',
                ];
    
                $customMessage = [
                    'shop_name.required' => 'Name is Requried',
                    'shop_name.regex' => 'Valid Name is Requried',
                    'vendor_address.required' => 'Address is Requried',
                    'shop_city.required' => 'City is Requried',
                    'shop_city.regex' => 'Valid City is Requried',
                    'shop_state.required' => 'State is Requried',
                    'shop_website.required' => 'Website is Requried',
                    'business_license_number.required' => 'License is Requried',
                    'pan_number.required' => 'PAN is Requried',
                    'gst_number.required' => 'GST is Requried',
                    'address_proof.required' => 'Address Proof is Requried',
                    'shop_state.regex' => 'Valid State is Requried',
                    'shop_country.required' => 'Country is Requried',
                    'shop_country.regex' => 'Valid Country is Requried',
                    'shop_pincode.required' => 'Pincode naumber is Requried',
                    'shop_mobile.required' => 'Mobile naumber is Requried',
                    'shop_mobile.numeric' => 'Vaild Mobile naumber is Requried'
                ];
    
                $this->validate($request, $rules, $customMessage);
    
                //Upload Image
                // $imageName = '';
                if ($request->hasFile('address_proof_image')) {
                    // $image_temp = $request->file('admin_image'); 
                    $save_img = $request->file('address_proof_image');
                    if ($save_img->isValid()) {
                        // $extension = $image_temp->getClientOriginalExtension();
                        // $imageName = rand(111,99999).'.'.$extension; 
                        // $iamge_path = 'admin/images/adminImage/'.$imageName; 
                        // Image::make($image_temp)->save($iamge_path);
                        $name_gen = hexdec(uniqid());
                        $img_ext = strtolower($save_img->getClientOriginalExtension());
                        $img_name = $name_gen.'.'.$img_ext;
                        $up_location = 'admin/images/VendorShopImage/';
                        $last_img = $up_location.$img_name;
                        $save_img->move($up_location,$img_name);
                    }
                }else if (!empty($data['current_shop_image'])) {
                    $img_name = $data['current_shop_image'];
                }else{
                    $img_name = "";
                }

                #Update Admin Table
                vendor_business_details::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['shop_name'=>$data['shop_name'], 'shop_address'=>$data['shop_address'], 'shop_email'=>$data['shop_email'], 'shop_city'=>$data['shop_city'], 'shop_state'=>$data['shop_state'], 'shop_country'=>$data['shop_country'], 'shop_pincode'=>$data['shop_pincode'], 'shop_mobile'=>$data['shop_mobile'], 'shop_website'=>$data['shop_website'], 'address_proof'=>$data['address_proof'], 'business_license_number'=>$data['business_license_number'], 'gst_number'=>$data['gst_number'], 'pan_number'=>$data['pan_number'], 'address_proof_image'=>$img_name ]);    

                return redirect()->back()->with('success_msg', 'Vendor details updated successfully !!');
            }    
            $vendorDetails = vendor_business_details::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }else if ($slug=="bank") {
            Session::put('page','update_bank_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;

                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'account_number' => 'required',
                    'bank_ifac_code' => 'required',
                ];
    
                $customMessage = [
                    'account_holder_name.required' => 'Name is Requried',
                    'account_holder_name.regex' => 'Valid Name is Requried',
                    'bank_name.required' => 'Bank Name is Requried',
                    'bank_name.regex' => 'Valid Name is Requried',
                    'account_number.required' => 'Account Number is Requried',
                    'bank_ifac_code.required' => 'Bank IFAC Number is Requried',
                ];
    
                $this->validate($request, $rules, $customMessage);

                #Update Bank Information for Vendor Table.
                vendor_bank_details::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name'=>$data['account_holder_name'], 'bank_name'=>$data['bank_name'], 'account_number'=>$data['account_number'], 'bank_ifac_code'=>$data['bank_ifac_code'] ]);
                return redirect()->back()->with('success_msg', 'Vendor details updated successfully !!');
            }    
            $vendorDetails = vendor_bank_details::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        }
        $countries = apps_countries::where('status', 1)->get()->toArray();
        return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails','countries'));
    }

    # Admin Logout
    public function AdminLogout(Request $request) {
        Auth::logout();
        return redirect('admin/login');
    }

    # Admin/superadmin/vendors manage in Admin_Manage.
    public function Admins($type=null){
        $admins = Admin::query();
        if (!empty($type)) {
            $admins = $admins->where('type',$type);
            $title = ucfirst($type)."s";
            Session::put('page','view_'.strtolower($title));
        }else{
            $title = "All Admins/Subadmins/Vendors";
            Session::put('page','view_all');
        }
        $admins = $admins->get()->toArray();
        // dd($admins);
        return view('admin.admins.admins')->with(compact('admins','title'));
    }

    # admin/superadmin see all information of vendor
    public function ViewVendorDetails($id){
        $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id',$id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails),true);
        // dd($vendorDetails);
        return view('admin.admins.View_vendor_details')->with(compact('vendorDetails'));
    }

    # admin/superadmin update all vendor active status.
    public function UpdateAdminStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
        }
    }

}
