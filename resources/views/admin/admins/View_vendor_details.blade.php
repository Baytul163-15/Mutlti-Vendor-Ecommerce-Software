@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">View Vendor Details</h3>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vendor Personal Information</h4>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Vendor Name</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Address</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['address'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor City</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['city'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor State</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['state'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Country</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['country'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Pincode</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Email</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['email'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Mobile</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['mobile'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vendor Address</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_personal']['name'] }}</td>
                                </tr>
                                @if(!empty($vendorDetails['image']))
                                <tr>
                                    <th scope="row">Vendor Image</th>
                                    <th scope="row">:</th>
                                    <td>
                                        <img src="{{ asset('admin/images/adminImage/'.$vendorDetails['image']) }}" style="width: 150px; height: 100px; border-radius: 0px;">
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vendor Business Information</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Shop Name</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Address</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_address'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Address Proof</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['address_proof'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Email</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_email'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop City</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_city'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop State</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_state'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Country</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_country'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Pincode</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_pincode'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Mobile</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_mobile'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Website</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['shop_website'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop Trade License</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['business_license_number'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop GST Number</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['gst_number'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Shop PAN Number</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_business']['pan_number'] }}</td>
                                </tr>
                                @if(!empty($vendorDetails['image']))
                                <tr>
                                    <th scope="row">Vendor Image</th>
                                    <th scope="row">:</th>
                                    <td>
                                        <img src="{{ asset('admin/images/adminImage/'.$vendorDetails['image']) }}" style="width: 150px; height: 100px; border-radius: 0px;">
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vendor Bank Information</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Account Holder Name</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_bank']['account_holder_name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bank Name</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_bank']['bank_name'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Account Number</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_bank']['account_number'] }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bank IFAC Code</th>
                                    <th scope="row">:</th>
                                    <td>{{ $vendorDetails['vendor_bank']['bank_ifac_code'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 