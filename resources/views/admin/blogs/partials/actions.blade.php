<div class="btn-group">
	<a href="{{$blog->getFrontUrl()}}" class="btn btn-info" target="_blank">
		<i class="fas fa-eye"></i>
	</a>
	<a href="{{route('admin.blogs.edit', ['blog' => $blog->id])}}" class="btn btn-info">
		<i class="fas fa-edit"></i>
	</a>
	<button 
		type="button" 
		class="btn btn-info" 
		data-toggle="modal" 
		data-target="#delete-modal"
		data-action="delete"
		data-id="{{$blog->id}}"
		>
		<i class="fas fa-trash"></i>
	</button>
</div>