@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="font-weight-bold">Catalogue Management</h4>
                <h5 class="font-weight-normal mb-0">Attributes</h5>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Attributes</h4>

                        @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_message') }}
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

                        <form class="forms-sample" action="{{ url('admin/add_edit_attributes/'.$product['id']) }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="product_name" class="font-weight-bold">Product Name :</label>
                                &nbsp; {{ $product['product_name'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_code" class="font-weight-bold">Product Code :</label>
                                &nbsp; {{ $product['product_code'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_color" class="font-weight-bold">Product Color :</label>
                                &nbsp; {{ $product['product_color'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="font-weight-bold">Product Price :</label>
                                &nbsp; {{ $product['product_price'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_selling" class="font-weight-bold">Product Selling :</label>
                                &nbsp; {{ $product['product_selling'] }}
                            </div>
                            <div class="form-group">
                                @if(empty($product['product_image']))
                                    <img src="{{ asset('admin/images/common_image/no-photo.jpg') }}" style="width: 90px; height: 80px; border-radius: 0px;">
                                @else
                                    <img src="{{ asset('admin/images/products_images/small_image/'.$product['product_image']) }}" style="width: 90px; height: 80px; border-radius: 0px;">
                                @endif
                            </div>                    
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="size[]" placeholder="Size" style="width:120px;" required/>
                                        <input type="text" name="price[]" placeholder="Price" style="width:120px;" required/>
                                        <input type="text" name="stock[]" placeholder="Stock" style="width:120px;" required/>
                                        <input type="text" name="sku[]" placeholder="SKU" style="width:120px;" required/>
                                        <a href="javascript:void(0);" class="add_button" title="Add Attribute">&nbsp;Add</a>
                                    </div>
                                </div>
                            </div>                    
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-dark">Cancel</a>
                        </form>
                        <br><br><br>
                        <h4 class="card-title">Product Attributes</h4>
                        <div class="table-responsive pt-3">
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Size
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th>
                                            Stock
                                        </th>
                                        <th>
                                            SKU
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
                                    @foreach($product['attributes'] as $attribute)
                                    <tr>
                                        <td>
                                            {{ $attribute['id'] }}
                                        </td>
                                        <td>
                                            {{ $attribute['size'] }}
                                        </td>
                                        <td>
                                            {{ $attribute['price'] }}
                                        </td>
                                        <td>
                                            {{ $attribute['stock'] }}
                                        </td>
                                        <td>
                                            {{ $attribute['sku'] }}
                                        </td>
                                        <td class="text-center"> 
                                            @if($attribute['status'] == 1)
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 15px; color: green;" class="mdi mdi-checkbox-blank-circle" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateAttributeStatus" id="attribute-{{ $attribute['id'] }}" attribute_id="{{ $attribute['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 15px; color: gray;" class="mdi mdi-checkbox-blank-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Attribute" href="{{ url('admin/add-edit-attribute/'.$attribute['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a title="Attribute" href="{{ url('admin/add_edit_attributes/'.$attribute['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-plus-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="attribute" moduleid="{{ $attribute['id'] }}">
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