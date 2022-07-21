@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="font-weight-bold">Catalogue Management</h4>
                <h5 class="font-weight-normal mb-0">Images</h5>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Images</h4>

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

                        <form class="forms-sample" action="{{ url('admin/add_images/'.$products['id']) }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="product_name" class="font-weight-bold">Product Name :</label>
                                &nbsp; {{ $products['product_name'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_code" class="font-weight-bold">Product Code :</label>
                                &nbsp; {{ $products['product_code'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_color" class="font-weight-bold">Product Color :</label>
                                &nbsp; {{ $products['product_color'] }}
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="font-weight-bold">Product Price :</label>
                                &nbsp; {{ $products['product_price'] }} TK
                            </div>
                            <div class="form-group">
                                <label for="product_selling" class="font-weight-bold">Product Selling :</label>
                                &nbsp; {{ $products['product_selling'] }} TK
                            </div>
                            <div class="form-group">
                                @if(empty($products['product_image']))
                                    <img src="{{ asset('admin/images/common_image/no-photo.jpg') }}" style="width: 200px; height: 160px; border-radius: 0px;">
                                @else
                                    <img src="{{ asset('admin/images/products_images/small_image/'.$products['product_image']) }}" style="width: 200px; height: 160px; border-radius: 0px;">
                                @endif
                            </div>                    
                            <div class="form-group">
                                <div class="field_wrapper">
                                    <input type="file" name="multiple_image[]" id="multiple_image" multiple="">
                                    <div class="row" id="preview_img"></div>
                                </div>
                            </div>                    
                            <button type="submit" class="btn btn-success px-5">Submit</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-danger px-5">Cancel</a>
                        </form>
                        <br><br><br>
                        <h4 class="card-title">Product Images</h4>
                        <div class="table-responsive pt-3">
                            <table id="products" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Images
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products['multiimage'] as $image)
                                    <tr>
                                        <td>
                                            {{ $image['id'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/images/products_images/small_image/'.$image['multiple_image']) }}" style="width: 90px; height: 80px; border-radius: 0px;">
                                        </td>
                                        <td class="text-center"> 
                                            @if($image['status'] == 1)
                                                <a class="updateImagesStatus" id="images-{{ $image['id'] }}" images_id="{{ $image['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 15px; color: green;" class="mdi mdi-checkbox-blank-circle" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateImagesStatus" id="images-{{ $image['id'] }}" images_id="{{ $image['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 15px; color: gray;" class="mdi mdi-checkbox-blank-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- <a title="Attribute" href="{{ url('admin/add-edit-attribute/'.$image['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a> -->
                                            <a href="javascript:void(0)" class="confirmDelete" module="images" moduleid="{{ $image['id'] }}">
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


<script>
  $(document).ready(function(){
   $('#multiple_image').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
</script>

@endsection