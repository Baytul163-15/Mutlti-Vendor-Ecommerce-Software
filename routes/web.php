<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\frontend\FrontendController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function(){
    #Admin Dashboard Route
    // Route::get('login',[AdminController::class,'AdminLogin']);
    Route::match(['get','post'],'login',[AdminController::class,'AdminLogin']);
    Route::group(['middleware'=>['admin']], function(){
        Route::get('/dashboard',[AdminController::class,'AdminDashboard']);

        #update superadmin password
        Route::match(['get','post'],'update-superadmin-password',[AdminController::class,'UpdateSuperadminPassword']);

        #update superadmin password
        Route::match(['get','post'],'update-superadmin-details',[AdminController::class,'UpdateSuperadminDetails']);

        #update superadmin password
        Route::match(['get','post'],'update-superadmin-personal-details',[AdminController::class,'UpdateSuperadminPersonalDetails']);

        #check current password
        Route::post('check-current-password',[AdminController::class,'CheckCurrentPassword']);

        #Update Vendor Details
        Route::match(['get','post'],'update-vendor-details/{slug}',[AdminController::class,'UpdateVendorDetails']);

        #view Admins/Subadmins/Vendors
        Route::get('admins/{type?}',[AdminController::class,'Admins']);

        #View Vendor Details
        Route::get('view-vendors-details/{id}',[AdminController::class,'ViewVendorDetails']);

        #update Admin Status
        Route::post('/update-admin-status',[AdminController::class,'UpdateAdminStatus']);

        #Admin Logout
        // Route::post('/logout', [AdminController::class,'AdminLogout']);
        Route::match(['get','post'],'/logout',[AdminController::class,'AdminLogout']);

        ##Type of Section##
        # Section
        Route::get('/sections', [SectionController::class,'sections']);
        # Update Section Status
        Route::post('/update-section-status',[SectionController::class,'UpdateSectionStatus']);
        # Delete Section
        Route::get('/delete-section/{id}',[SectionController::class,'DeleteSection']);
        # Add Section and Edit Section
        Route::match(['get','post'],'/edit-section/{id?}',[SectionController::class,'AddEditSection']);

        ##Type of Categorys##
        # Category Route
        Route::get('/categories', [CategoryController::class,'Categories']);
        # update Section Status
        Route::post('/update-category-status',[CategoryController::class,'UpdateCategoryStatus']);
        # Add Category and Edit Categorys
        Route::match(['get','post'],'/add-edit-category/{id?}',[CategoryController::class,'AddEditCategory']);
        # Append Category Lavel come from (custom.js)
        Route::get('/append-categories-level', [CategoryController::class,'AppendCategoryLavel']);
        # Delete Category
        Route::get('/delete-category/{id}',[CategoryController::class,'DeleteCategory']);
        # Delete Category Image
        Route::get('/delete-section-image/{id}',[CategoryController::class,'DeleteCategoryImage']);

        ##Type of Brand##
        # Brand Route
        Route::get('/brands', [BrandController::class,'Brands']);
        # Update Brand Status
        Route::post('/update-brand-status',[BrandController::class,'UpdateBrandStatus']);
        # Delete Brand
        Route::get('/delete-brand/{id}',[BrandController::class,'DeleteBrand']);
        # Add Brand and Edit Brand
        Route::match(['get','post'],'/add-edit-brand/{id?}',[BrandController::class,'AddEditBrand']);
        # Delete Brand Image
        Route::get('/delete-brand-image/{id}',[BrandController::class,'DeleteBrandImage']);

        ##Type of Products##
        # All Products show
        Route::get('/products',[ProductController::class,'Products']);
        # Update Product Status
        Route::post('/update-product-status',[ProductController::class,'UpdateProductStatus']);
        # Delete Brand
        Route::get('/delete-product/{id}',[ProductController::class,'DeleteProduct']);
        # Add Product and Edit Product
        Route::match(['get','post'],'/add-edit-products/{id?}',[ProductController::class,'AddEditProduct']);
        # Delete Product Image
        Route::get('/delete-product-image/{id}',[ProductController::class,'DeleteProductImage']);
        # Delete Product vedio
        Route::get('/delete-product-vedio/{id}',[ProductController::class,'DeleteProductVedio']);

        #Product Attributes
        Route::match(['get','post'],'/add_edit_attributes/{id}',[ProductController::class,'AddProductAttributes']);
        # Update Attributes Status
        Route::post('/update-attribute-status',[ProductController::class,'UpdateAttributeStatus']);
        # Delete product attribute
        Route::get('/delete-attribute/{id}',[ProductController::class,'DeleteProductAttribute']);
        # Attribute edit/update
        Route::post('/edit-attribute/{id}',[ProductController::class,'UpdateAttribute']);

        # Product Multiple Image upload
        Route::match(['get','post'],'/add_images/{id}',[ProductController::class,'AddProductMultipleImage']);
        # Update multi_image status
        Route::post('/update-images-status',[ProductController::class,'UpdateImagesStatus']);
        # Delete Multi_image
        Route::get('/delete-images/{id}',[ProductController::class,'DeleteMultiImage']);

        #Slider Section
        Route::get('slider',[SliderController::class,'SliderSection']);
        Route::post('/update-slider-status',[SliderController::class,'UpdateSliderStatus']);
        Route::get('/delete-slider/{id}',[SliderController::class,'DeleteSlider']);
        Route::match(['get','post'],'/add-edit-slider/{id?}',[SliderController::class,'AddEditSlider']);
        Route::get('/delete-slider-image/{id}',[SliderController::class,'DeleteSliderImage']);
    });
});

############################## Start Frontend All Page ###############################
Route::namespace('App\Http\Controllers\frontend')->group(function(){
    Route::get('/', [FrontendController::class, 'HomePage'])->name('home');
});
