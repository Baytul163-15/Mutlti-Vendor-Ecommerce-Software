@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Catalogue Management</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Categories</h4>
                        <a href="{{ url('admin/add-edit-category') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add category</a>
                        <!-- <p class="card-description">
                        </p> -->
                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="categorys" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Parent Category
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Section
                                        </th>
                                        <th>
                                            Category Iamge
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
                                    @foreach($categorie as $categori)
                                    
                                    @if(isset($categori['parentcategory']['category_name']) && !empty($categori['parentcategory']['category_name']))
                                        @php  
                                            $parent_category = $categori['parentcategory']['category_name'];
                                        @endphp
                                    @else
                                        @php
                                            $parent_category = "Root";
                                        @endphp
                                    @endif

                                    <tr>
                                        <td>
                                            {{ $categori['id'] }}
                                        </td>
                                        <td>
                                            {{ $parent_category }}
                                        </td>
                                        <td>
                                            {{ $categori['category_name'] }}
                                        </td>
                                        <td>
                                            {{ $categori['section']['section_name'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/images/category_images/'.$categori['category_image']) }}" style="width: 100px; height: 100px; border-radius: 0px;">
                                        </td>
                                        <td>
                                            @if($categori['created_at'] == NULL)
                                            <span class="text-danger">No time set</span>
                                            @else
                                            {{ Carbon\Carbon::parse($categori['created_at'])->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="text-center"> 
                                            @if($categori['status'] == 1)
                                                <a class="updateCategoryStatus" id="category-{{ $categori['id'] }}" category_id="{{ $categori['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 23px; color:#5050B2;" class="fa-solid fa-circle-check" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateCategoryStatus" id="category-{{ $categori['id'] }}" category_id="{{ $categori['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 23px; color: gray;" class="fa-solid fa-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Category" href="{{ url('admin/add-edit-category/'.$categori['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <!-- <a title="Category" class="confirmDelete" href="{{ url('admin/delete-category/'.$categori['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-delete"></i>
                                            </a> -->

                                            <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid="{{ $categori['id'] }}">
                                                <i style="font-size: 30px; color:red;" class="mdi mdi-delete"></i>
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