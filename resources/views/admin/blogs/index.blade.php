@extends('admin._layout.layout')

@section('seo_title', __('Blogs'))

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('Blogs')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.index.index')}}">
                            @lang('Home')
                        </a>
                    </li>
                    <li class="breadcrumb-item active">@lang('Blogs')</li>
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

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Search Blogs</h3>
						<div class="card-tools">
							<a href="{{route('admin.blogs.add')}}" class="btn btn-success">
                                <i class="fas fa-plus-square"></i>
                                @lang('Add new Blog')
                            </a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form id="entities-filter-form">
							<div class="row">
								<div class="col-md-3 form-group">
									<label>Name</label>
									<input type="text" class="form-control" placeholder="Search by name" name="name">
								</div>
								
								<div class="col-md-2 form-group">
									<label>Category</label>
									<select class="form-control" name="blog_category_id">
										<option value="">--Choose Category --</option>
										@foreach(\App\Models\BlogCategory::orderBy('priority')->get() as $blogCategory)
										<option value="{{$blogCategory->id}}">{{$blogCategory->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-2 form-group">
									<label>Important</label>
									<select class="form-control" name="index_page">
										
										<option value="1">yes</option>
										<option value="0">no</option>
									</select>
								</div>
								<div class="col-md-5 form-group">
									<label>Tag</label>
									<select class="form-control" multiple name="tag_ids">
										@foreach(\App\Models\Tag::orderBy('name')->get() as $tag)
										<option value="{{$tag->id}}">{{$tag->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</form>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">

					</div>
				</div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('All Blogs')</h3>
                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="entities-list-table" class="table table-bordered">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">Photo</th>
                                    <th style="width: 20%;">Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th class="text-center">Tags</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<form action="{{route('admin.blogs.delete')}}" method="post" class="modal fade" id="delete-modal">
    @csrf
    <input type="hidden" name="id" value="">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Blog</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete blog?</p>
                <strong data-container="name"></strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
<!-- /.modal -->

@endsection

@push('footer_javascript')
<script type="text/javascript">
	
	
	$('#entities-filter-form [name="brand_id"]').select2({
		"theme": "bootstrap4"
	});
	
	$('#entities-filter-form [name="blog_category_id"]').select2({
		"theme": "bootstrap4"
	});
	
	$('#entities-filter-form [name="tag_ids"]').select2({
		"theme": "bootstrap4"
	});
	
	$('#entities-filter-form [name]').on('change keyup' , function (e) {
		$('#entities-filter-form').trigger('submit');
	});
	
	$('#entities-filter-form').on('submit', function (e) {
		e.preventDefault();
		
		entitiesDataTable.ajax.reload(null, true);
	});

	let entitiesDataTable = $('#entities-list-table').DataTable({
		"serverSide": true,
		"processing": true,
		"ajax": {
			"url": "{{route('admin.blogs.datatable')}}",
			"type": "post",
			"data": function(dtData) {
				dtData["_token"] = "{{csrf_token()}}";
				
				dtData["name"] = $('#entities-filter-form [name="name"]').val();
				dtData["blog_category_id"] = $('#entities-filter-form [name="blog_category_id"]').val();
				
				dtData["index_page"] = $('#entities-filter-form [name="index_page"]').val();
				dtData["tag_ids"] = $('#entities-filter-form [name="tag_ids"]').val();
				
			}
		},
		"pageLength": 5,
		"lengthMenu": [5, 10, 25, 50, 100, 250, 500, 1000],
		"order": [[6, 'desc']],
		"columns": [
			{"name": "id", "data": "id"},
			{"name": "photo1", "data": "photo1", "orderable": false, "searchable": false, "className": "text-center"},
			{"name": "name", "data": "name"},
			
			{"name": "blog_category_name", "data": "blog_category_name"},
			{"name": "tags", "data": "tags", "orderable": false},
			{"name": "created_at", "data": "created_at", "className": "text-center"},
			{"name": "actions", "data": "actions", "orderable": false, "searchable": false, "className": "text-center"}
		]
	});

	$('#entities-list-table').on('click', '[data-action="delete"]', function (e) {
		//e.stopPropagation();
		//e.preventDefault();

		//let id = $(this).data('id');
		let id = $(this).attr('data-id');
		let name = $(this).attr('data-name');

		$('#delete-modal [name="id"]').val(id);
		$('#delete-modal [data-container="name"]').html(name);
	});

	$('#delete-modal').on('submit', function (e) {
		e.preventDefault();

		$(this).modal('hide');

		$.ajax({
			"url": $(this).attr('action'), //citanje actio atributa sa forme
			"type": "post",
			"data": $(this).serialize() //citanje svih polja na formi  tj sve sto ima "name" atribut
		}).done(function (response) {

			toastr.success(response.system_message);

			// da refreshujemo datatables!!!

			entitiesDataTable.ajax.reload(null, false);//drugi parametar false zaci da se NE RESETUJE paginacija

		}).fail(function () {
			toastr.error("@lang('Error occured while deleting blog')");
		});
	});

</script>
@endpush