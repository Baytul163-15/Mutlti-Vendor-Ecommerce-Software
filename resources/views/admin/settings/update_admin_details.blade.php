@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Setting</h3>
                <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update admin details</h4>

                        @if(Session::has('error_msg'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_msg') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(Session::has('success_msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_msg') }}
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

                        <form class="forms-sample" action="{{ url('admin/update-superadmin-personal-details') }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email Address</label>
                                <input type="text" class="form-control" id="admin_email" name="admin_email" placeholder="Enter your email address" value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label>Admin Type</label>
                                <input type="text" class="form-control" id="admin_type" name="admin_type" placeholder="Enter your type" value="{{ Auth::guard('admin')->user()->type }}">
                            </div>
                            <div class="form-group">
                                <label for="current_password">Admin Name</label>
                                <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Enter your name" value="{{ Auth::guard('admin')->user()->name }}">
                                <span id="check_password"></span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Admin Mobile Number</label>
                                <input type="text" class="form-control" id="admin_number" name="admin_number" placeholder="Enter 11 digit mobile number" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="11" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="admin_image">Admin Image</label>
                                <input type="file" class="form-control" id="admin_image" name="admin_image">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/adminImage/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                                @endif
                            </div>

                            @if(!empty(Auth::guard('admin')->user()->image))
                            <div class="form-group">
                                <div class="controls">
                                    <img src="{{ asset('admin/images/adminImage/'.Auth::guard('admin')->user()->image) }}" style="width: 150px; height: 100px">
                                </div>
                            </div>
                            <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
                            @endif
                            
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection