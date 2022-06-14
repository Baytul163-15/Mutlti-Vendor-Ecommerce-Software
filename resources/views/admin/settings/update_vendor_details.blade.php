@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Vendor Details</h3>
                <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
            </div>

            @if($slug=="personal")
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Vendor Personal Information</h4>

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

                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="vendor_name">Vendor Name</label>
                                <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Enter your name" value="{{ Auth::guard('admin')->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_address">Vendor Address</label>
                                <input type="text" class="form-control" id="vendor_address" name="vendor_address" placeholder="Enter your address" value="{{ $vendorDetails['address'] }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_email">Vendor Email</label>
                                <input type="text" class="form-control" id="vendor_email" name="vendor_email" placeholder="Enter your email address" value="{{ Auth::guard('admin')->user()->email }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_city">Vendor City</label>
                                <input type="text" class="form-control" id="vendor_city" name="vendor_city" placeholder="Enter your city name" value="{{ $vendorDetails['city'] }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_state">Vendor State</label>
                                <input type="text" class="form-control" id="vendor_state" name="vendor_state" placeholder="Enter your state name" value="{{ $vendorDetails['state'] }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_country">Vendor Country</label>
                                <!-- <input type="text" class="form-control" id="vendor_country" name="vendor_country" placeholder="Enter your country name" value="{{ $vendorDetails['country'] }}"> -->
                                <select class="form-control" id="vendor_country" name="vendor_country" style="color: #495057">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $countrie)
                                    <option value="{{ $countrie['country_name'] }}" @if($countrie['country_name'] == $vendorDetails['country']) selected @endif >
                                        {{ $countrie['country_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vendor_pincode">Vendor Pincode</label>
                                <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" placeholder="Enter your country name" value="{{ $vendorDetails['pincode'] }}">
                            </div>
                            <div class="form-group">
                                <label for="vendor_number">Vendor Mobile Number</label>
                                <input type="text" class="form-control" id="vendor_number" name="vendor_number" placeholder="Enter 11 digit mobile number" value="{{ Auth::guard('admin')->user()->mobile }}" maxlength="11" minlength="10">
                            </div>
                            <div class="form-group">
                                <label>Vendor Type</label>
                                <input type="text" class="form-control" id="admin_type" name="admin_type" placeholder="Enter your type" value="{{ Auth::guard('admin')->user()->type }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="vendor_image">Vendor Image</label>
                                <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/vendorImage/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                                @endif
                            </div>
                            @if(!empty(Auth::guard('admin')->user()->image))
                            <div class="form-group">
                                <div class="controls">
                                    <img src="{{ asset('admin/images/vendorImage/'.Auth::guard('admin')->user()->image) }}" style="width: 150px; height: 100px">
                                </div>
                            </div>
                            <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                            @endif
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($slug=="business")
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Vendor Business Information</h4>

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

                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="shop_name">Shop Name</label>
                                <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Enter your name" value="{{ $vendorDetails['shop_name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_address">Shop Address</label>
                                <input type="text" class="form-control" id="shop_address" name="shop_address" placeholder="Enter your address" value="{{ $vendorDetails['shop_address'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_email">Shop Email</label>
                                <input type="text" class="form-control" id="shop_email" name="shop_email" placeholder="Enter your email address" value="{{ $vendorDetails['shop_email'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_city">Shop City</label>
                                <input type="text" class="form-control" id="shop_city" name="shop_city" placeholder="Enter your city name" value="{{ $vendorDetails['shop_city'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_state">Shop State</label>
                                <input type="text" class="form-control" id="shop_state" name="shop_state" placeholder="Enter your state name" value="{{ $vendorDetails['shop_state'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_country">Shop Country</label>
                                <!-- <input type="text" class="form-control" id="shop_country" name="shop_country" placeholder="Enter your country name" value="{{ $vendorDetails['shop_country'] }}"> -->
                                <select class="form-control" id="vendor_country" name="shop_country" style="color: #495057">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $countrie)
                                    <option value="{{ $countrie['country_name'] }}" @if($countrie['country_name'] == $vendorDetails['shop_country']) selected @endif >
                                        {{ $countrie['country_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="shop_pincode">Shop Pincode</label>
                                <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" placeholder="Enter your pincode name" value="{{ $vendorDetails['shop_pincode'] }}">
                            </div>
                            <div class="form-group">
                                <label for="shop_mobile">Shop Mobile Number</label>
                                <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" placeholder="Enter 11 digit mobile number" value="{{ $vendorDetails['shop_mobile'] }}" maxlength="11" minlength="10">
                            </div>
                            <div class="form-group">
                                <label for="shop_website">Shop Website</label>
                                <input type="text" class="form-control" id="shop_website" name="shop_website" placeholder="Enter shop website name" value="{{ $vendorDetails['shop_website'] }}">
                            </div>
                            <div class="form-group">
                                <label for="address_proof">Shop Address Proof</label>
                                <select class="form-select" name="address_proof" id="address_proof" aria-label="Default select example">
                                    <!-- <option disabled selected>Select One</option> -->
                                    <option value="Passport" @if($vendorDetails['address_proof']== "Passport") selected @endif >Passport</option>
                                    <option value="National Card" @if($vendorDetails['address_proof']== "National Card") selected @endif>National Card</option>
                                    <option value="PAN" @if($vendorDetails['address_proof']== "PAN") selected @endif>PAN</option>
                                    <option value="Driving License" @if($vendorDetails['address_proof']== "Driving License") selected @endif>Driving License</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="business_license_number">Business Licence Number</label>
                                <input type="text" class="form-control" id="business_license_number" name="business_license_number" placeholder="Enter business licence number" value="{{ $vendorDetails['business_license_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="gst_number">GST Number</label>
                                <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="Enter GST number" value="{{ $vendorDetails['gst_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="pan_number">PAN Number</label>
                                <input type="text" class="form-control" id="pan_number" name="pan_number" placeholder="Enter PAN number" value="{{ $vendorDetails['pan_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="address_proof_image">Address Proof Image</label>
                                <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                @if(!empty(Auth::guard('admin')->user()->image))
                                <a target="_blank" href="{{ url('admin/images/VendorShopImage/'.$vendorDetails['address_proof_image'] ) }}">View Image</a>
                                @endif
                            </div>
                            @if(!empty(Auth::guard('admin')->user()->image))
                            <div class="form-group">
                                <div class="controls">
                                    <img src="{{ asset('admin/images/VendorShopImage/'.$vendorDetails['address_proof_image']) }}" style="width: 150px; height: 100px">
                                </div>
                            </div>
                            <input type="hidden" name="current_shop_image" value="{{ $vendorDetails['address_proof_image'] }}">
                            @endif
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($slug=="bank")
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Vendor Bank Information</h4>

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

                        <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="account_holder_name">Account Holder Name</label>
                                <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Enter account holder name" value="{{ $vendorDetails['account_holder_name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Bank Name</label>
                                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter your bank name" value="{{ $vendorDetails['bank_name'] }}">
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter your account number" value="{{ $vendorDetails['account_number'] }}">
                            </div>
                            <div class="form-group">
                                <label for="bank_ifac_code">Bank IFAC Code</label>
                                <input type="text" class="form-control" id="bank_ifac_code" name="bank_ifac_code" placeholder="Enter your IFAC code" value="{{ $vendorDetails['bank_ifac_code'] }}">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/dashboard') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection