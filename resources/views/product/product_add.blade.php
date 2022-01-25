@extends('layouts.app')
@section('content')
<form method="POST" action="{{ Route('product.store') }}">
@csrf
<div class="col-md-6">
   <div class="form-group">
       <label> Category<span style="color:red;"> * </span></label>
       <select class="form-control" name="category_id" id="category_id">
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
       <label>SubCategory</label>
       <select class="form-control" name="sub_category_id" id="sub_category_id" >
                <option value="">-SELECT-</option>
            </select>
       @if ($errors->has('sub_category_id')) 
       <span class="help-block">
           <strong class="text-danger">{{ $errors->first('sub_category_id') }}</strong>
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
       <label> Content </label>
       <textarea  class="form-control" name="content" placeholder="Enter  Content" id="content">{{old('name')}}</textarea>
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
</div></div></form>
<!-- <script>
   function category_change()
   {
       var category_id=document.getElementById('category_id').value;
        // Creating Our XMLHttpRequest object 
        var xhr = new XMLHttpRequest();
        // Making our connection  
        var url = '/get_subcategory/'+category_id;
        xhr.open("GET", url, true);
  
        // function execute after request is successful 
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              //  console.log(this.responseText);
              var arr=this.responseText;
              alert(arr.length);
                alert(this.responseText)
            }
        }
        // Sending our request 
        xhr.send();
    }
</script> -->
<script>
let token = "{{ csrf_token() }}";
$('#category_id').on('change', function (e) {
        $.ajax({
            type: "get",
            url: "{{url('get_subcategory')}}",
            async: true,
            data: {
                category_id: $('#category_id').val()
            },
            success: function (response) {
                $.each(response,function(key, value)
                {
                    $("#sub_category_id").append('<option value=' + value['category_id'] + '>' + value['title'] + '</option>');
                });
            }
        });
    });
</script>

@endsection
