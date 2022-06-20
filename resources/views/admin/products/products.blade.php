@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Catalogue Management</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Products</h4>
                        <a href="{{ url('admin/add-edit-products') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add Product</a>
                        <!-- <p class="card-description">
                        </p> -->
                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Section
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Product Name
                                        </th>
                                        <th>
                                            Product Price
                                        </th>
                                        <th>
                                            Product Video
                                        </th>
                                        <!-- <th>
                                            Product Color
                                        </th> -->
                                        <th>
                                            Product Image
                                        </th>
                                        <th>
                                            Added By
                                        </th>
                                        <th>
                                            Staus
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                            {{ $product['id'] }}
                                        </td>
                                        <td>
                                            {{ $product['section']['section_name'] }}
                                        </td>
                                        <td>
                                            {{ $product['category']['category_name'] }}
                                        </td>
                                        <td>
                                            {{ $product['product_name'] }}
                                        </td>
                                        <td>
                                            {{ $product['product_price'] }}
                                        </td>
                                        <td>
                                            @if(empty($product['product_vedio']))
                                                <img src="{{ asset('admin/vedio/products_vedio/no-video.jpg') }}" style="width: 120px; height: 95px; border-radius: 0px;">
                                            @else
                                                <video width="120" height="95" autoplay muted>
                                                    <source src="{{ asset('admin/vedio/products_vedio/'.$product['product_vedio']) }}" type="video/mp4">
                                                    <!-- <source src="movie.ogg" type="video/ogg"> -->
                                                </video>
                                            @endif
                                        </td>
                                        <!-- <td>
                                            {{ $product['product_selling'] }}
                                        </td> -->
                                        <!-- <td>
                                            {{ $product['product_color'] }}
                                        </td> -->
                                        <td>
                                            @if(empty($product['product_image']))
                                                <img src="{{ asset('admin/images/common_image/no-photo.jpg') }}" style="width: 90px; height: 80px; border-radius: 0px;">
                                            @else
                                                <img src="{{ asset('admin/images/products_images/small_image/'.$product['product_image']) }}" style="width: 90px; height: 80px; border-radius: 0px;">
                                            @endif
                                        </td>
                                        <td>
                                            @if($product['admin_type']=="vendor")
                                                <a target="_blank" href="{{ url('admin/view-vendors-details/'.$product['admin_id']) }}">{{ ucfirst($product['admin_type']) }}</a>
                                            @else
                                                {{ ucfirst($product['admin_type']) }}
                                            @endif
                                        </td>
                                        <!-- <td>
                                            <img src="{{ asset('admin/images/products_images/'.$product['product_image']) }}" style="width: 100px; height: 60px; border-radius: 0px;">
                                        </td> -->
                                        <td class="text-center"> 
                                            @if($product['status'] == 1)
                                                <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 15px; color: green;" class="mdi mdi-checkbox-blank-circle" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 15px; color: gray;" class="mdi mdi-checkbox-blank-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Product" href="{{ url('admin/add-edit-products/'.$product['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a title="Product" href="{{ url('admin/add_edit_attributes/'.$product['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-plus-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="product" moduleid="{{ $product['id'] }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection