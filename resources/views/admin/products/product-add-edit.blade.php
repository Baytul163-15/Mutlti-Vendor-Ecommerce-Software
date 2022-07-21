@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="font-weight-bold">Catalogue Management</h4>
                <h5 class="font-weight-normal mb-0">Products</h5>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>

                        @if(Session::has('error_msg'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_msg') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="forms-sample" @if(empty($product['id'])) action="{{ url('admin/add-edit-products') }}" @else action="{{ url('admin/add-edit-products/'.$product['id']) }}" @endif method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select class="form-control text-dark" name="category_id" id="category_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $section)
                                        <optgroup label="{{ $section['section_name'] }}"></optgroup>
                                        @foreach($section['categories'] as $category)
                                            <option value="{{ $category['id'] }}" @if(!empty($product['category_id']) && $product['category_id'] == $category['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $category['category_name'] }}</option>
                                            @foreach($category['subcategories'] as $subcategory)
                                                <option value="{{ $subcategory['id'] }}" @if(!empty($product['category_id']) && $product['category_id'] == $subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Select Brand</label>
                                <select class="form-control text-dark" name="brand_id" id="brand_id">
                                    <option value="">Select</option>
                                    @foreach($brands as $brand)
                                        <!-- <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option> -->
                                        <option value="{{ $brand['id'] }}" @if(!empty($product['brand_id']) && $product['brand_id'] == $brand['id']) selected="" @endif>{{ $brand['brand_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter your product name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ $product['product_name'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_code">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter your product code" @if(!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ $product['product_code'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_color">Product Color</label>
                                <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter your product color" @if(!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ $product['product_color'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter your product price" @if(!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ $product['product_price'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_selling">Product Selling</label>
                                <input type="text" class="form-control" id="product_selling" name="product_selling" placeholder="Enter your product selling price" @if(!empty($product['product_selling'])) value="{{ $product['product_selling'] }}" @else value="{{ $product['product_selling'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Product Discount (%)</label>
                                <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter your product discount" @if(!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @else value="{{ $product['product_discount'] }}" @endif>
                            </div>
                            <!-- <div class="form-group">
                                <label for="product_size">Product Size</label>
                                <input type="text" class="form-control" id="product_size" name="product_size" placeholder="Enter your product size" @if(!empty($product['product_size'])) value="{{ $product['product_size'] }}" @else value="{{ $product['product_size'] }}" @endif>
                            </div> -->
                            <div class="form-group">
                                <label for="product_size">Product Size</label>
                                <select class="form-control" name="product_size" id="product_size" style="color:#000">
                                    <option>Select Size</option>
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                    <option>XXXL</option>
                                    <option @if(!empty($product['product_size']) && $product['product_size'] == $product['product_size']) selected="" @endif>{{ $product['product_size'] }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_slug">Product Slug</label>
                                <input type="text" class="form-control" id="product_slug" name="product_slug" placeholder="Enter your product slug" @if(!empty($product['product_slug'])) value="{{ $product['product_slug'] }}" @else value="{{ $product['product_slug'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_weight">Product Weight</label>
                                <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter your product weight" @if(!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ $product['product_weight'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_description">Product Description</label>
                                <textarea name="product_description" id="product_description" class="form-control" rows="3">{{ $product['product_description'] }}</textarea>
                            </div> 
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter your product meta title" @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ $product['meta_title'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter your product meta description" @if(!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ $product['meta_description'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter your product meta description" @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ $product['meta_keywords'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="product_vedio">Product Vedio (Recommended size less then 2MB)</label>
                                <input type="file" class="form-control" id="product_vedio" name="product_vedio">
                                @if(!empty($product['product_vedio']))
                                <a target="_blank" href="{{ url('admin/vedio/products_vedio/'.$product['product_vedio']) }}">View Vedio</a>&nbsp; | &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="product-vedio" moduleid="{{ $product['id'] }}">Delete Image</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="product_image">Product Image (Recommended size 1000x1000)</label>
                                <input type="file" class="form-control" id="product_image" name="product_image">
                                @if(!empty($product['product_image']))
                                <a target="_blank" href="{{ url('admin/images/products_images/small_image/'.$product['product_image']) }}">View Image</a>&nbsp; | &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="product-image" moduleid="{{ $product['id'] }}">Delete Image</a>
                                @endif
                            </div> 
                            <div class="form-group">
                                <label for="is_featured">Featured Product&nbsp;&nbsp;</label>
                                <input type="checkbox" name="is_featured" id="is_featured" value="Yes" @if(!empty($product['is_featured']) && $product['is_featured'] == "Yes") checked="" @endif>
                            </div>                     
                            <div class="form-group">
                                <label for="is_bestseller">Best Seller&nbsp;&nbsp;</label>
                                <input type="checkbox" name="is_bestseller" id="is_bestseller" value="Yes" @if(!empty($product['is_bestseller']) && $product['is_bestseller'] == "Yes") checked="" @endif>
                            </div>                     
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection