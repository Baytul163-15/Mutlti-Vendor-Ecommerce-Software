@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Catalogue Management</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sliders</h4>
                        <a href="{{ url('admin/add-edit-slider') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add Slider</a>
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
                                            Slider Image
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Slider Title
                                        </th>
                                        <th>
                                            Slider Link
                                        </th>
                                        <th>
                                            Slider Alt
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
                                    @foreach($sliders as $slider)
                                    <tr>
                                        <td>
                                            {{ $slider['id'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('frontend/images/banners/'.$slider['slider_image']) }}" style="width: 100px; height: 70px; border-radius: 0px;" alt="{{ $slider['alt'] }}">
                                        </td>
                                        <td>
                                            {{ $slider['type'] }}
                                        </td>
                                        <td>
                                            {{ $slider['title'] }}
                                        </td>
                                        <td>
                                            {{ $slider['link'] }}
                                        </td>
                                        <td>
                                            {{ $slider['alt'] }}
                                        </td>
                                        <td>
                                            @if($slider['created_at'] == NULL)
                                            <span class="text-danger">No time set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($slider['created_at'])->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center"> 
                                            @if($slider['status'] == 1)
                                                <a class="updateSliderStatus" id="slider-{{ $slider['id'] }}" slider_id="{{ $slider['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 23px; color:#5050B2;" class="fa-solid fa-circle-check" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateSliderStatus" id="slider-{{ $slider['id'] }}" slider_id="{{ $slider['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 23px; color: gray;" class="fa-solid fa-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Slider" href="{{ url('admin/add-edit-slider/'.$slider['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="slider" moduleid="{{ $slider['id'] }}">
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