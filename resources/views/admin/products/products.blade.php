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
                        <a href="{{ url('admin/add-edit-product') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add Product</a>
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
                                            Product Name
                                        </th>
                                        <th>
                                            Product Price
                                        </th>
                                        <th>
                                            Selling Price
                                        </th>
                                        <th>
                                            Product Color
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
                                            {{ $product['product_name'] }}
                                        </td>
                                        <td>
                                            {{ $product['product_price'] }}
                                        </td>
                                        <td>
                                            {{ $product['product_selling'] }}
                                        </td>
                                        <td>
                                            {{ $product['product_color'] }}
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
                                            <a title="Product" href="{{ url('admin/add-edit-product/'.$product['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
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