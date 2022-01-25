@extends('layouts.app')
@section('content')
@if (Session::has('success'))
                    <div class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error') }}
                    </div>
                    @endif
<div class="col-xs-12">
<div class="box">
<div class="box-header">
<h3 class="box-title">Categories List</h3>
<div class="box-tools">
<div class="input-group input-group-sm pull-right">
<a href="{{ Route('categories.create') }}" class="btn btn-primary">Add New</a>
</div>
</div>
</div>
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
<tr>
<th>#</th>
<th>Slug</th>
<th>Title</th>
<th>Content</th>
<th>Action</th>
</tr>
@if($categories->count() > 0)
@foreach($categories as $key=> $value)
<tr>
<td>{{ (($categories->currentPage() - 1 ) * $categories->perPage() ) + $loop->iteration }}</td>
<td>{{ isset($value->slug) ? $value->slug : '-' }}</td>
<td>{{ isset($value->title) ? $value->title : '-' }}</td>
<td>{{ isset($value->content) ? $value->content : '-' }}</td>

<td>
<span>
<a href="{{ Route('categories.edit' ,encrypt($value->category_id) ) }}">
<i class="fa fa-edit">Edit</i>
</a>
</span>
<span>
<a title="Delete" onclick=deleteCategories({{ $value->category_id }}) style="cursor:pointer;">
<i class="fa fa-remove">Delete</i>
</a>
</span>
</td>
</tr>
@endforeach
@else
<tr>
<td colspan="6" class="text-bold text-danger text-center">
No Data Found
</td>
</tr>
@endif
</table>
</div>
{{ $categories->render() }}
</div>
</div>


<script>
let token = "{{ csrf_token() }}";
function deleteCategories(id)
{
swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover this !",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$.ajax({type: "DELETE",
url: '/categories/destroy',
async:true,
data: {
'_token'     : token,
'category_id'  : id},
success: function(response) {
console.log(response);
if(response) {
if(response == "Success") {
swal("Success!", "Categories deleted successfully.", "success", {
button: "Ok",
}).then(function() {
window.location.reload();
});
}
if(response == "Error") {
swal("Error!", "Error deleting Categories!.", "error", {
button: "Ok",
})
}
} else {
console.log("Error");
}
}
});
} else {
swal("Cancelled!", "You cancelled the operation.", "error", {
button: "Ok",
})
}
});
}
</script>
@endsection