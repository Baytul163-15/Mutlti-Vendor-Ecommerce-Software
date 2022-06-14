@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Catalogue Management</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sections</h4>
                        <a href="{{ url('admin/edit-section') }}" class="btn btn-primary" style="max-width:200px; float:right; display:inline-block;">Add section</a>
                        <!-- <p class="card-description">
                        </p> -->
                        @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success: </strong> {{ Session::get('success_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table id="sections" class="table table-bordered">
                                <thead style="">
                                    <tr class="text-center">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
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
                                    @foreach($sections as $section)
                                    <tr>
                                        <td>
                                            {{ $section['id'] }}
                                        </td>
                                        <td>
                                            {{ $section['section_name'] }}
                                        </td>
                                        <td class="text-center"> 
                                            @if($section['status'] == 1)
                                                <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 15px; color: green;" class="mdi mdi-checkbox-blank-circle" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 15px; color: gray;" class="mdi mdi-checkbox-blank-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a title="Section" href="{{ url('admin/edit-section/'.$section['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-pencil-box"></i>
                                            </a>
                                            <!-- <a title="Section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}">
                                                <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-delete"></i>
                                            </a> -->

                                            <a href="javascript:void(0)" class="confirmDelete" module="section" moduleid="{{ $section['id'] }}">
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