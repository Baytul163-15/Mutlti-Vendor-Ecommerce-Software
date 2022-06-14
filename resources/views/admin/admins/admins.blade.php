@extends('admin.admin_master')
@section('admin')
<div class="main-panel">
    <h2>Setting</h2>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <p class="card-description">
                            
                        </p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Admin ID
                                        </th>
                                        <th>
                                            Image
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Mobile
                                        </th>
                                        <th>
                                            Email
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
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td>
                                            {{ $admin['id'] }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('admin/images/adminImage/'.$admin['image']) }}" alt="">
                                        </td>
                                        <td>
                                            {{ $admin['name'] }}
                                        </td>
                                        <td>
                                            {{ $admin['type'] }}
                                        </td>
                                        <td>
                                            {{ $admin['mobile'] }}
                                        </td>
                                        <td>
                                            {{ $admin['email'] }}
                                        </td>
                                        <td class="text-center"> 
                                            @if($admin['status'] == 1)
                                                <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">
                                                    <i style="font-size: 15px; color: green;" class="mdi mdi-checkbox-blank-circle" status="Active"></i>
                                                </a>
                                            @else 
                                                <a class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{ $admin['id'] }}" href="javascript:void(0)">  
                                                    <i style="font-size: 15px; color: gray;" class="mdi mdi-checkbox-blank-circle" status="Inactive"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($admin['type']=="vendor")
                                                <a href="{{ url('admin/view-vendors-details/'.$admin['id']) }}">
                                                    <i style="font-size: 30px; color: #4B49AC;" class="mdi mdi-file-document"></i>
                                                </a>
                                            @endif
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