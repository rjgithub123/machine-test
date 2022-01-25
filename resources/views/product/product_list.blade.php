@extends('layouts.app')
@section('content')
<div class="col-xs-12">
<div class="box">
<div class="box-header">
<h3 class="box-title">Product List</h3>
<div class="box-tools">
<div class="input-group input-group-sm">
<a href="{{ Route('product.create') }}" class="btn btn-primary">Add New</a>
</div>
</div>
</div>
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
<tr>
<th>#</th>
<th>Category</th>
<th>Sub category</th>
<th>Slug</th>
<th>Content</th>
<th>Action</th>
</tr>

@if($product->count() > 0)
@foreach($product as $key=> $value)
<tr>
<td>{{ (($product->currentPage() - 1 ) * $product->perPage() ) + $loop->iteration }}</td>
<td>{{ isset($value->category->category_id) ? $value->category->title : '-' }}</td>
<td>{{ isset($value->sub_category->category_id) ? $value->sub_category->title : '-' }}</td>
<td>{{ isset($value->slug) ? $value->slug : '-' }}</td>
<td>{{ isset($value->content) ? $value->content : '-' }}</td>
<span>

<td></span>
<span>
<a title="Delete" onclick=deleteProduct({{ $value->product_id }}) style="cursor:pointer;">
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
{{ $product->render() }}
</div>
</div>


<script>
let token = "{{ csrf_token() }}";
function deleteProduct(id)
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
url: '/product/destroy',
async:true,
data: {
'_token'     : token,
'product_id'  : id},
success: function(response) {
console.log(response);
if(response) {
if(response == "Success") {
swal("Success!", "Product deleted successfully.", "success", {
button: "Ok",
}).then(function() {
window.location.reload();
});
}
if(response == "Error") {
swal("Error!", "Error deleting Product!.", "error", {
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