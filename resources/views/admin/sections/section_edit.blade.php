@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Catalogue Management</h3>
                <h6 class="font-weight-normal mb-0">Section</h6>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>

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

                        <form class="forms-sample" @if(empty($section['id'])) action="{{ url('admin/edit-section') }}" @else action="{{ url('admin/edit-section/'.$section['id']) }}" @endif method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="sections_name">Section Name</label>
                                <input type="text" class="form-control" id="sections_name" name="sections_name" placeholder="Enter your section name" @if(!empty($section['section_name'])) value="{{ $section['section_name'] }}" @else value="{{ $section['sections_name'] }}" @endif>
                            </div>                         
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/sections') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection