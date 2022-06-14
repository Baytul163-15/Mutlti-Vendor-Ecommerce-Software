@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Catalogue Management</h3>
                <h6 class="font-weight-normal mb-0">Brand</h6>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>

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

                        <form class="forms-sample" @if(empty($brand['id'])) action="{{ url('admin/add-edit-brand') }}" @else action="{{ url('admin/add-edit-brand/'.$brand['id']) }}" @endif method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="brand_name">Brand Name</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter your brand name" @if(!empty($brand['brand_name'])) value="{{ $brand['brand_name'] }}" @else value="{{ $brand['brand_name'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="brand_image">Brand Image</label>
                                <input type="file" class="form-control" id="brand_image" name="brand_image">
                                @if(!empty($brand['brand_image']))
                                <a target="_blank" href="{{ url('admin/images/brand_image/'.$brand['brand_image']) }}">View Image</a>&nbsp; | &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="brand-image" moduleid="{{ $brand['id'] }}">Delete Image</a>
                                @endif
                            </div>                         
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/brands') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection