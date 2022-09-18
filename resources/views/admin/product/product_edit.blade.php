@extends('layouts.admin.app')
@section('content')
<div class="container mt-5">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<form method="post" enctype="multipart/form-data" action="{{route('product-update',$product->id)}}">
@csrf   
@method('PUT')

<div class="row">
<div class="col-md-8">
<h3 class="text-center">Welcome To The Product Section</h3>
</div>
<div class="col-md-4">
@if($product->photo)
<img class="img-responsive float-end" style="border:1px solid white;border-radius:10px;" height="150px;" src="{{asset($product->photo)}}" alt="">
@endif
</div>
</div>
<hr>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="name">Name :</label>
<input class="form-control" type="text" name="name" id="name" placeholder="Enter Product Name" value="{{$product->name}}">
@error('name')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="original_price">Original Price :</label>
<input class="form-control" type="text" name="original_price" id="original_price" placeholder="Enter Product Original Price" value="{{$product->original_price}}">
@error('original_price')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="selling_price">Selling Price :</label>
<input class="form-control" type="text" name="selling_price" id="selling_price" placeholder="Enter Product Selling Price" value="{{$product->selling_price}}">
@error('selling_price')
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
<label for="description">Description :</label>
<textarea class="form-control" name="description" id="description" cols="30" rows="30" placeholder="Enter Product Description">
{{ $product->description }}
</textarea>
@error('description')
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
<label for="quantity">Quantity :</label>
<input class="form-control" type="text" name="quantity" id="quantity" placeholder="Enter Product Quantity" value="{{$product->quantity}}">
@error('quantity')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="slug">slug :</label>
<input class="form-control" type="text" name="slug" id="slug" placeholder="Enter Product slug" value="{{$product->slug}}">
@error('slug')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="catagory_id">Catagory :</label>
<select name="catagory_id" id="catagory_id" class="form-control form-select">
<option value="null">Select A Catagory</option>
@foreach($catagories as $catagory)
<option value="{{ $catagory->id }}" {{ $catagory->id==$product->catagory_id ? 'selected' : '' }}>
{{ $catagory->name }}
</option>
@endforeach
</select>
@error('catagory_id')
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
<label for="status">Status :</label>
<select name="status" id="status" class="form-control form-select">
<option value="null">Select A Status</option>
<option value="1" {{ $product->status==1 ? 'selected' : '' }}>Available</option>
<option value="0" {{ $product->status==0 ? 'selected' : '' }}>Out Of Stock</option>
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
<label for="photo">Photo :</label>
<input class="form-control" type="file" name="photo" id="photo" placeholder="Enter Product slug" value="{{old('photo')}}">
@error('photo')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-4 mt-4">
<div class="form-group">
<label for=""></label>
<button class="btn btn-primary float-start" style="width:140px; height:35px;">
<span class="mdi mdi-plus-circle">
</span>
&nbsp;
Update
</button>
<a class="btn btn-danger float-end" href="{{route('product-index')}}" style="width:140px; height:35px;">
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