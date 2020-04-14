@extends('admin._layout.layout')

@section('seo_title', __('Edit Blog'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Edit Blog')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">@lang('Home')</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.blogs.index')}}">@lang('Blogs')</a>
                    </li>
                    <li class="breadcrumb-item active">
                        @lang('Edit Blog')
                    </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @lang('Editing blog')
                            #{{$blog->id}}
                            -
                            {{$blog->name}}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form"
                        action="{{route('admin.blogs.update', ['blog' => $blog->id])}}"
                        method="post"
                        enctype="multipart/form-data"
                        role="form"
                    >
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                
                                    <div class="form-group">
                                        <label>Blog Category</label>
                                        <select 
                                            name="blog_category_id" 
                                            class="form-control @if($errors->has('blog_category_id')) is-invalid @endif"
                                        >
                                            <option value="">-- Choose Category --</option>
                                            @foreach($blogCategories as $blogCategory)
                                            <option 
                                                value="{{$blogCategory->id}}"
                                                @if($blogCategory->id == old('blog_category_id', $blog->blog_category_id))
                                                selected
                                                @endif
                                            >{{$blogCategory->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'blog_category_id'])
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input 
                                            name="name"
                                            value="{{old('name', $blog->name)}}"
                                            type="text" 
                                            class="form-control @if($errors->has('name')) is-invalid @endif" 
                                            placeholder="Enter name"
                                        >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'name'])
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea 
                                            name="description"
                                            class="form-control @if($errors->has('description')) is-invalid @endif" 
                                            placeholder="Enter Description"
                                        >{{old('description', $blog->description)}}</textarea>
                                    </div>

                              


                                    <div class="form-group">
                                        <label>On Index Page</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="on-index-page-no" 
                                                name="important"
                                                value="0"
                                                @if(0 == old('important', $blog->important))
                                                checked
                                                @endif
                                                class="custom-control-input"
                                            >
                                            <label class="custom-control-label" for="on-index-page-no">No</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="on-index-page-yes" 
                                                name="important"
                                                value="1"
                                                @if(1 == old('important', $blog->important))
                                                checked
                                                @endif
                                                class="custom-control-input"
                                            >
                                            <label class="custom-control-label" for="on-index-page-yes">Yes</label>
                                        </div>
                                        <!-- TRIK ZA IZMESTANJE GRESAKA SA BACKEND-a NA BILO KOJU POZICIJU -->
                                        <div style="display:none;" class="form-control @if($errors->has('important')) is-invalid @endif"></div>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'important'])
                                    </div>

                                    <div class="form-group select2-purple">
                                        <label>Tags</label>
                                        <select 
                                            name="tag_id[]"
                                            class="form-control @if($errors->has('tag_id')) is-invalid @endif" 
                                            multiple
                                        >
                                            @foreach($tags as $tag)
                                            <option 
                                                value="{{$tag->id}}"
                                                @if(
                                                    is_array(old('tag_id', $blog->tags->pluck('id')->toArray()))
                                                    && in_array($tag->id, old('tag_id', $blog->tags->pluck('id')->toArray()))
                                                )
                                                selected
                                                @endif
                                            >{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'tag_id'])
                                    </div>

                                    <div class="form-group">
                                        <label>Choose New Photo 1</label>
                                        <input 
											name="photo1"
											type="file" 
											class="form-control @if($errors->has('photo1')) is-invalid @endif"
										>
										@include('admin._layout.partials.form_errors', ['fieldName' => 'photo1'])
                                    </div>
                                    <div class="form-group">
                                        <label>Choose New Photo 2</label>
                                        <input 
											name="photo2"
											type="file" 
											class="form-control @if($errors->has('photo2')) is-invalid @endif "
										>
										@include('admin._layout.partials.form_errors', ['fieldName' => 'photo2'])
                                    </div>
									<div class="form-group">
                                        <label>Details</label>
                                        <textarea 
                                            name="details"
                                            class="form-control @if($errors->has('details')) is-invalid @endif" 
                                            placeholder="Enter Details"
                                        >{{old('details', $blog->details)}}</textarea>
										@include('admin._layout.partials.form_errors', ['fieldName' => 'details'])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Photo 1</label>

                                                <div class="text-right">
                                                    <button 
														type="button" 
														class="btn btn-sm btn-outline-danger"
														data-action="delete-photo"
														data-photo="photo1"
													>
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
														src="{{$blog->getPhoto1Url()}}" 
														alt="" 
														class="img-fluid"
														data-container="photo1"
													>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Photo 2</label>

                                                <div class="text-right">
                                                    <button 
														type="button" 
														class="btn btn-sm btn-outline-danger"
														data-action="delete-photo"
														data-photo="photo2"
													>
                                                        <i class="fas fa-remove"></i>
                                                        Delete Photo
                                                    </button>
                                                </div>
                                                <div class="text-center">
                                                    <img 
														src="{{$blog->getPhoto2Url()}}" 
														alt="" 
														class="img-fluid"
														data-container="photo2"
													>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{route('admin.blogs.index')}}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('footer_javascript')
<script src="/themes/admin/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="/themes/admin/plugins/ckeditor/adapters/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	
	$('#entity-form [name="details"]').ckeditor({
		"height": "400px",
		"filebrowserBrowseUrl": "{{route('elfinder.ckeditor')}}"
		//"allowedContent": true,
		//"contentsCss": [
		//	"{{url('/themes/front/style.css')}}"
		//]
	});
	
	$('#entity-form').on('click', '[data-action="delete-photo"]', function (e) {
		e.preventDefault();
		
		let photo = $(this).attr('data-photo'); //'photo1' ili 'photo2'
		
		$.ajax({
			"url": "{{route('admin.blogs.delete_photo', ['blog' => $blog->id])}}",
			"type": "post",
			"data": {
				"_token": "{{csrf_token()}}",
				"photo": photo
			}
		}).done(function (response) {
			
			toastr.success(response.system_message);
			
			$('img[data-container="' + photo + '"]').attr('src', response.photo_url);
			
		}).fail(function() {
			toastr.error('Error while deleteing photo');
		});
	});
    

   
    
    //select name=blog_category_id
    $('#entity-form [name="blog_category_id"]').select2({
        "theme": "bootstrap4"
    });
    
    //select name=tag_id[]
    $('#entity-form [name="tag_id[]"]').select2({
        "theme": "bootstrap4"
    });

    $('#entity-form').validate({
        rules: {
          
            "blog_category_id": {
                "required": true
            },
            "name": {
                "required": true,
                "maxlength": 255
            },
            "description": {
                "maxlength": 2000
            },
            "important": {
                "required": true
            }

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
	

</script>
@endpush