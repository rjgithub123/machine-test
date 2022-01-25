@extends('layouts.app')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Add Sub Categories</h3>
    </div>
</div>
<form method="POST" action="{{ Route('sub_categories.store') }}">
    @csrf
    <div class="col-md-6">
        <div class="form-group">
            <label> Category <span style="color:red;"> * </span></label>
            <select class="form-control" name="category_id">
                <option value="">-SELECT-</option>
                @foreach($category as $key=> $value)
                <option value="{{$value->category_id}}">{{$value->title}}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Title <span style="color:red;"> * </span></label>
            <input type="text" class="form-control" name="title" placeholder="Enter Title" id="title" value="{{ old('title')}}" required>
            @if ($errors->has('title'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label> Content <span style="color:red;"> * </span></label>
            <textarea class="form-control" name="content" placeholder="Enter  Content" id="content">{{old('name')}}</textarea>
            @if ($errors->has('content'))
            <span class="help-block">
                <strong class="text-danger">{{ $errors->first('content') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input type="submit" class="btn-primary" name="submit" value="Submit">
        </div>
    </div>
</form>
@endsection