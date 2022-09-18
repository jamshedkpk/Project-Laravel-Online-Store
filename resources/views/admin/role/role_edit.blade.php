@extends('layouts.admin.app')
@section('content')
<div class="container mt-5">

<div class="row">
<div class="col-md-6 offset-3">
<h4>
Welcome To The Role Section
</h4>
</div>
</div>
<hr>

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<form action="{{route('role-update',$role->id)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-md-8 offset-2">
<div class="form-group">
<label for="name">Name :</label>
<input type="text" id="name" name="name" class="form-control" placeholder="Enter Role Name" value="{{$role->name}}">
@error('name')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>

<div class="row text-center">
<div class="col-md-8 offset-2">
<div class="form-group">
<button class="btn btn-primary w-100">
<span class="mdi mdi-plus-circle">
</span>
&nbsp;
Add
</button>
&nbsp;
&nbsp;
</div>
</div>
</div>
<div class="row text-center">
<div class="col-md-8 offset-2">
<a class="btn btn-danger w-100" href="{{route('role-index')}}">
<span class="mdi mdi-home-variant">
</span>
&nbsp;
Homepage
</a>

</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection