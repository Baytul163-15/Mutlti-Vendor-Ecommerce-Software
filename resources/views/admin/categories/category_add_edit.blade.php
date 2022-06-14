@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="font-weight-bold">Catalogue Management</h4>
                <h5 class="font-weight-normal mb-0">Categories</h5>
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

                        <form class="forms-sample" @if(empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/'.$category['id']) }}" @endif method="post" enctype="multipart/form-data"> 
                            @csrf
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter your category name" @if(!empty($category['category_name'])) value="{{ $category['category_name'] }}" @else value="{{ $category['category_name'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="section_id">Section Name</label>
                                <select class="form-control" name="section_id" id="section_id" style="color:#000">
                                    <option value="">Select</option>
                                    @foreach($getSections as $sections)
                                        <option value="{{ $sections['id'] }}" @if(!empty($category['section_id']) && $category['section_id'] == $sections['id']) selected="" @endif>{{ $sections['section_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="appendCategoriesLeval">
                                @include('admin.categories.append_categories_level')
                            </div>
                            <div class="form-group">
                                <label for="category_image">Category Image</label>
                                <input type="file" class="form-control" id="category_image" name="category_image">
                                @if(!empty($category['category_image']))
                                <a target="_blank" href="{{ url('admin/images/category_images/'.$category['category_image']) }}">View Image</a>&nbsp; | &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="section-image" moduleid="{{ $category['id'] }}">Delete Image</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="category_discount">Category Discount</label>
                                <input type="text" class="form-control" id="category_discount" name="category_discount" placeholder="Enter your category discount" @if(!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @else value="{{ $category['category_discount'] }}" @endif>
                            </div> 
                            <div class="form-group">
                                <label for="category_description">Category Description</label>
                                <textarea name="category_description" id="category_description" class="form-control" rows="3">{{ $category['category_description'] }}</textarea>
                            </div> 
                            <div class="form-group">
                                <label for="url">Category URL</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Enter your URL" @if(!empty($category['url'])) value="{{ $category['url'] }}" @else value="{{ $category['url'] }}" @endif>
                            </div> 
                            <div class="form-group">
                                <label for="meta_title">Category Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter your meta title" @if(!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @else value="{{ $category['meta_title'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Category Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter your meta description" @if(!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @else value="{{ $category['meta_description'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="meta_keybords">Category Meta Keybords</label>
                                <input type="text" class="form-control" id="meta_keybords" name="meta_keybords" placeholder="Enter your meta keybords" @if(!empty($category['meta_keybords'])) value="{{ $category['meta_keybords'] }}" @else value="{{ $category['meta_keybords'] }}" @endif>
                            </div>                       
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/categories') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection