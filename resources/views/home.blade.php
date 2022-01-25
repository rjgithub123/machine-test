@extends('layouts.app')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

    </div>
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
    <div class="page-heading">

    </div>
    <div class="page-content">
<div class="card">
    <div class="card-body">
        <h1>
            Welcome!
        </h1>
    </div>
</div>
</div>
<!--Row-->
@endsection
