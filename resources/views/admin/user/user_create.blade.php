@extends('layouts.admin.app')
@section('content')
<div class="container mt-5">
<div class="row">
<div class="col-md-6 offset-3">
<h4 class="text-center">Welcome To The User Section</h4>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<form method="post" enctype="multipart/form-data" action="{{route('user-store')}}">
@csrf   
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="name">Name :</label>
<input class="form-control" type="text" name="name" id="name" placeholder="Enter Name" value="{{old('name')}}">
@error('name')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="email">Email :</label>
<input class="form-control" type="text" name="email" id="email" placeholder="Enter Email" value="{{old('email')}}">
@error('email')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="password">Password :</label>
<input class="form-control" type="text" name="password" id="password" placeholder="Enter Password" value="{{old('password')}}">
@error('password')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="address">Address :</label>
<textarea class="form-control" name="address" id="address" cols="30" rows="30" placeholder="Enter Address">
</textarea>
@error('address')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="mobile">Mobile :</label>
<input class="form-control" type="text" name="mobile" id="mobile" placeholder="Enter Mobile No" value="{{old('mobile')}}">
@error('mobile')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="country_id">Country :</label>
<select name="country_id" id="country_id" class="form-control form-select">
<option value="null">Select A Country</option>
@foreach($countries as $country)
<option value="{{ $country->id }}">
{{ $country->name }}
</option>
@endforeach
</select>
@error('country_id')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="state_id">State :</label>
<select name="state_id" id="state_id" class="form-control form-select">
<option value="null">Select A State</option>
@foreach($states as $state)
<option value="{{ $state->id }}">
{{ $state->name }}
</option>
@endforeach
</select>
@error('state_id')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="city_id">City :</label>
<select name="city_id" id="city_id" class="form-control form-select">
<option value="null">Select A City</option>
@foreach($cities as $city)
<option value="{{ $city->id }}">
{{ $city->name }}
</option>
@endforeach
</select>
@error('city_id')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="status">Status :</label>
<select name="status" id="status" class="form-control form-select">
<option value="null">Select A Status</option>
<option value="1">Active</option>
<option value="0">Not Active</option>
</select>
@error('status')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="role_id">Role :</label>
<select name="role_id" id="role_id" class="form-control form-select">
@foreach($roles as $role)
<option value="{{$role->id}}">
{{ $role->name }}
</option>
@endforeach
</select>
@error('role_id')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="photo">Photo :</label>
<input class="form-control" type="file" name="photo" id="photo" placeholder="Enter Photo" value="{{old('photo')}}">
@error('photo')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group mt-4">
<button class="btn btn-primary w-100" style="height:38px;">
<span class="mdi mdi-plus-circle">
</span>
&nbsp;
Add
</button>
</div>
</div>
<div class="col-md-4">
<div class="form-group mt-4">
<a class="btn btn-danger w-100" href="{{route('dashboard')}}">
<span class="mdi mdi-home-variant">
</span>
&nbsp;
Homepage
</a>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection

