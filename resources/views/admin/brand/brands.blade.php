@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Catalogue Management</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brands</h4>
                        <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add Brand</a>
                        <!-- <p class="card-description">
                        </p> -->
                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="brands" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Brand Name
                                        </th>
                                        <th>
                                            Brand Image
                                        </th>
                                        <th>
                                            Created_at
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
                                    @foreach($brands as $brand)
                                    <tr>
                                        <td>
                                            {{ $brand['id'] }}
                                        </td>
                                        <td>
                                            {{ $brand['brand_name'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/images/brand_image/'.$brand['brand_image']) }}" style="width: 100px; height: 70px; border-radius: 0px;">
                                        </td>
                                        <td>
                                            @if($brand['created_at'] == NULL)
                                            <span class="text-danger">No time set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($brand['created_at'])->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center"> 
                                            @if($brand['status'] == 1)
                                                <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 23px; color:#5050B2;" class="fa-solid fa-circle-check" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 23px; color: gray;" class="fa-solid fa-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Brand" href="{{ url('admin/add-edit-brand/'.$brand['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="brand" moduleid="{{ $brand['id'] }}">
                                                <i style="font-size: 30px; color: red;" class="mdi mdi-delete"></i>
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