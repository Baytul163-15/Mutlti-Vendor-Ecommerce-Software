@extends('admin.admin_master')
@section('admin')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Catalogue Management</h3>
                <h6 class="font-weight-normal mb-0">Slider</h6>
            </div>
            <div class="col-md-6 grid-margin stretch-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>

                        @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error: </strong> {{ Session::get('error_message') }}
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

                        <form class="forms-sample" @if(empty($sliders['id'])) action="{{ url('admin/add-edit-slider') }}" @else action="{{ url('admin/add-edit-slider/'.$sliders['id']) }}" @endif method="post" enctype="multipart/form-data"> 
                            @csrf
                            <input type="hidden" name="id" value="{{ $sliders['id'] }}">
                            <div class="form-group">
                                <label for="type">Slider/Banner Type</label>
                                <select class="form-control" name="type" id="type" requried="">
                                    <option value="">Select</option>
                                    <option @if(!empty($sliders['type']) && $sliders['type']=="slider") selected="" @endif value="slider">Slider</option>
                                    <option @if(!empty($sliders['type']) && $sliders['type']=="fix") selected="" @endif value="fix">Fix Banner</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Slider/Banner Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter your title" @if(!empty($sliders['title'])) value="{{ $sliders['title'] }}" @else value="{{ $sliders['title'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="link">Slider/Banner Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Enter your link" @if(!empty($sliders['link'])) value="{{ $sliders['link'] }}" @else value="{{ $sliders['link'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="alt">Slider/Banner ALT</label>
                                <input type="text" class="form-control" id="alt" name="alt" placeholder="Enter your alt" @if(!empty($sliders['alt'])) value="{{ $sliders['alt'] }}" @else value="{{ $sliders['alt'] }}" @endif>
                            </div>
                            <div class="form-group">
                                <label for="slider_image">Slider/Banner Image</label>
                                <input type="file" class="form-control" id="slider_image" name="slider_image" onChange="mainThamUrl(this)">
                                <img src="" id="mainThmb" alt=""><br>
                                @if(!empty($sliders['slider_image']))
                                <a target="_blank" href="{{ url('frontend/images/banners/'.$sliders['slider_image']) }}">View Image</a>&nbsp; | &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="slider-image" moduleid="{{ $sliders['id'] }}">Delete Image</a>
                                @endif
                            </div>
                            @if(!empty($sliders['slider_image'])) 
                            <div class="form-group">
                                <div class="controls">
                                    <img src="{{ asset('frontend/images/banners/'.$sliders['slider_image']) }}" alt="{{ $sliders['alt'] }}" style="width: 500px; height: 200px">
                                </div>
                            </div>
                            <input type="hidden" name="current_admin_image" value="{{ $sliders['slider_image'] }}">
                            @endif
                            @if(!empty($sliders['slider_image']))                        
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            @else
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            @endif
                            <a href="{{ url('admin/slider') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(85).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}	
</script>

@endsection