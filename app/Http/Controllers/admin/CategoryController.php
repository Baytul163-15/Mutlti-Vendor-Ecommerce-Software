<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Session;

class CategoryController extends Controller
{
    public function Categories(){
        Session::put('page','categories');
        $categorie = Category::with(['section','parentcategory'])->get()->toArray();
        // dd($categorie);
        return view('admin.categories.category')->with(compact('categorie'));
    }

    # admin/superadmin update all vendor active status.
    public function UpdateCategoryStatus(Request $request){
        if ($request->ajax()) {
            $data= $request->all();
            // echo "<pre>"; print_r($data); die;

            if ($data['status']== "Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function AddEditCategory(Request $request,$id=null){
        Session::put('page','categories');
        if ($id=="") {
            $title = "Add Category";
            $category = new Category;
            #Parent Category/Main Category
            $getCategories = array();
            $message = "Category added successfully!";
        }else{
            $title = "Edit Category";
            $category = Category::find($id);
            #Parent Category/Main Category
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            $message = "Category updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'parent_id' => 'required',
                // 'category_image' => 'required',
                // 'category_discount' => 'required',
                'category_description' => 'required',
                'url' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'meta_keybords' => 'required',
            ];

            $customMessage = [
                'category_name.required' => 'Category Name is Requried',
                'parent_id.required' => 'Parent Category is Requried',
                // 'category_image.required' => 'Category Image is Requried',
                // 'category_discount.required' => 'Category Discount Name is Requried',
                'category_description.required' => 'Category Description is Requried',
                'url.required' => 'Section Name is Requried',
                'meta_title.required' => 'Category URL is Requried',
                'meta_description.required' => 'Meta Description is Requried',
                'meta_keybords.required' => 'Meta Keybords is Requried',
                'category_name.regex' => 'Valid Section Name is Requried',
            ];

            $this->validate($request, $rules, $customMessage);

            #Upload Category Image
            if ($request->hasFile('category_image')) {
                // $image_temp = $request->file('category_image'); 
                $cat_image = $request->file('category_image');
                if ($cat_image->isValid()) {
                    // $extension = $image_temp->getClientOriginalExtension();
                    // $imageName = rand(111,99999).'.'.$extension; 
                    // $iamge_path = 'admin/images/adminImage/'.$imageName; 
                    // Image::make($image_temp)->save($iamge_path);
                    $name_gen = hexdec(uniqid());
                    $img_ext = strtolower($cat_image->getClientOriginalExtension());
                    $img_name = $name_gen.'.'.$img_ext;
                    $upload_location = 'admin/images/category_images/';
                    $last_img = $upload_location.$img_name;
                    $cat_image->move($upload_location,$img_name);
                    $category->category_image = $img_name;
                }
            }else{
                $category->category_image = "";
            }

            $category->category_name = $data['category_name'];
            $category->section_id = $data['section_id'];
            $category->parent_id = $data['parent_id'];
            $category->img_name;
            $category->category_discount = $data['category_discount'];
            $category->category_description = $data['category_description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keybords = $data['meta_keybords'];
            $category->status = 1;
            $category->save();

            return redirect('admin/categories')->with('success_message', $message);
        }

        #Get all Section 
        $getSections = Section::get()->toArray();
        
        return view('admin.categories.category_add_edit')->with(compact('title','category','message','getSections','getCategories'));
    }

    #Append Category Lavel come from (custom.js)=> Web
    public function AppendCategoryLavel(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            // echo $data['section_id']; die;
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
            // dd($getCategories);
            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }    
    }

    #Delete Category
    // public function DeleteCategory($id){
    //     Category::where('id',$id)->delete();
    //     $message = "Category has been deleted successfully!";
    //     return redirect()->back()->with('success_message', $message);
    // }
    
    #Delete Category
    public function DeleteCategory($id){
        # Get Category image
        $catImage = Category::select('category_image')->where('id',$id)->first();
        # Eet image link
        $cat_image_path = 'admin/images/category_images/';
        # Delete Category_image from Category_image folder if exists
        if (!empty($catImage->category_image)) {
            unlink($cat_image_path.$catImage->category_image);
            Category::findOrFail($id)->delete();
            $message = "Category has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);  
        }else {
            Category::findOrFail($id)->delete();
            $message = "Category has been deleted successfully!";
            return redirect()->back()->with('success_message', $message);    
        }  
    }

    #Delete Category
    // public function DeleteCategory($id){
    //     $category = Category::findOrFail($id);
    //     $img = $category->category_image;
    //     $category_image_path = 'admin/images/category_images/';
    //     unlink($category_image_path.$img);
    //     Category::findOrFail($id)->delete();
    //     $message = "Category has been deleted successfully!";
    //     return redirect()->back()->with('success_message', $message);
    // }

    #Delete Category Iamge
    public function DeleteCategoryImage($id){
        #Get category image
        $categoryImage = Category::select('category_image')->where('id',$id)->first();
        #get image link
        $category_image_path = 'admin/images/category_images/';
        #Delete category image from category_image folder if exists
        if (file_exists($category_image_path.$categoryImage->category_image)) {
            unlink($category_image_path.$categoryImage->category_image);
        }

        #Delete category image from categories folder
        Category::where('id',$id)->update(['category_image'=>'']);
        $message = "Category Image has been delected successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
