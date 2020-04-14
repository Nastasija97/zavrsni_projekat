@extends('admin._layout.layout')

@section('seo_title', __('Add new Blog'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Add new blog')</h1>
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
                        @lang('Add new blog')
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
                        <h3 class="card-title">@lang('Enter data for the blog')</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form 
                        id="entity-form"
                        action="{{route('admin.blogs.insert')}}"
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
                                                @if($blogCategory->id == old('blog_category_id'))
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
                                            value="{{old('name')}}"
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
                                        >{{old('description')}}</textarea>
										@include('admin._layout.partials.form_errors', ['fieldName' => 'description'])
                                    </div>

                                    <div class="form-group">
                                        <label>Important</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input 
                                                type="radio" 
                                                id="on-index-page-no" 
                                                name="important"
                                                value="0"
                                                @if(0 == old('important'))
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
                                                @if(1 == old('important'))
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
                                                    is_array(old('tag_id'))
                                                    && in_array($tag->id, old('tag_id'))
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
                                            class="form-control @if($errors->has('photo2')) is-invalid @endif"
                                        >
                                        @include('admin._layout.partials.form_errors', ['fieldName' => 'photo2'])
                                    </div>
									<div class="form-group">
                                        <label>Details</label>
                                        <textarea 
                                            name="details"
                                            class="form-control @if($errors->has('details')) is-invalid @endif" 
                                            placeholder="Enter Details"
                                        >{{old('details')}}</textarea>
										@include('admin._layout.partials.form_errors', ['fieldName' => 'details'])
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-5">
                                    
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
<script type="text/javascript">
    
    
    
    
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
            "price": {
                "required": true,
                "min": 0.01
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