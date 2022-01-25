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
<h3 class="box-title">Sub Categories List</h3>
<div class="box-tools">
<div class="input-group input-group-sm pull-right">
<a href="{{ Route('sub_categories.create') }}" class="btn btn-primary">Add New</a>
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

</tr>
@if($subcategories->count() > 0)
@foreach($subcategories as $key=> $value)
<tr>
<td>{{ (($subcategories->currentPage() - 1 ) * $subcategories->perPage() ) + $loop->iteration }}</td>
<td>{{ isset($value->slug) ? $value->slug : '-' }}</td>
<td>{{ isset($value->title) ? $value->title : '-' }}</td>
<td>{{ isset($value->content) ? $value->content : '-' }}</td>
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
{{ $subcategories->render() }}
</div>
</div>
@endsection