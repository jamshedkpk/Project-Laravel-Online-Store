@extends('layouts.admin.app')
@section('content')
<div class="container mt-5">

<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body">
<form action="{{route('catagory-update',$catagory->id)}}" method="post"  enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-md-8">
<h3 class="text-center">Welcome To The Product Section</h3>
</div>
<div class="col-md-4">
@if($catagory->photo)
<img class="img-responsive float-end" style="border:1px solid white;border-radius:10px;" height="150px;" src="{{asset($catagory->photo)}}" alt="">
@endif
</div>
</div>
<hr>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="name">Name :</label>
<input type="text" id="name" name="name" class="form-control" placeholder="Enter Catagory Name" value="{{$catagory->name}}">
@error('name')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>    
</div>
<div class="col-md-6">
<div class="form-group">
<label for="slug">Slug :</label>
<input type="text" id="slug" name="slug" class="form-control" placeholder="Enter Catagory Slug" value="{{$catagory->slug}}">
@error('slug')
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
<textarea class="form-control" id="description" name="description" value="{{old('description')}}" placeholder="Enter Catagory Description" rows="4">
{{$catagory->description}}
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
<div class="col-md-6">
<div class="form-group">
<label for="meta_title">Meta Title :</label>
<input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Enter Catagory Meta Title" value="{{$catagory->meta_title}}">
@error('meta_title')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>    
</div>
<div class="col-md-6">
<div class="form-group">
<label for="meta_keyword">Meta Keyword :</label>
<input type="text" id="meta_keyword" name="meta_keyword" class="form-control" placeholder="Enter Catagory Meta Keyword" value="{{$catagory->meta_keyword}}">
@error('meta_keyword')
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
<label for="meta_description">Meta Description :</label>
<textarea class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description')}}" placeholder="Enter Meta Description" rows="4">
{{ $catagory->meta_description }}
</textarea>
@error('meta_description')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<div class="form-group row">
<label class="col-sm-3 col-form-label" for="status">Status :</label>
<div class="col-sm-4">
<div class="form-check">
<label class="form-check-label">
<input type="radio" class="form-check-input" name="status" id="Active" value="1" {{ $catagory->status==1 ? 'checked' : '' }}> Active <i class="input-helper"></i></label>
</div>
</div>
<div class="col-sm-5">
<div class="form-check">
<label class="form-check-label">
<input type="radio" class="form-check-input" name="status" id="Not Active" value="0" {{ $catagory->status==0 ? 'checked' : '' }}> Not Active <i class="input-helper"></i></label>
</div>
</div>
@error('status')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>    
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-sm-3 col-form-label">Popularity :</label>
<div class="col-sm-4">
<div class="form-check">
<label class="form-check-label">
<input {{ $catagory->popular== 1 ? 'checked' : '' }} type="radio" class="form-check-input" name="popular" id="popular" value="1"> Popular <i class="input-helper"></i></label>
</div>
</div>
<div class="col-sm-5">
<div class="form-check">
<label class="form-check-label">
<input {{ $catagory->popular==0 ? 'checked' : '' }} type="radio" class="form-check-input" name="popular" id="not popular" value="0"> Not Popular <i class="input-helper"></i></label>
</div>
</div>
@error('popular')
<span class="text-danger">
{{ $message }}
</span>
@enderror

</div>
</div>
</div>
<div class="row text-center">
<div class="col-md-6">
<div class="form-group">
<input type="file" id="photo" name="photo"  class="form-control">
@error('photo')
<span class="text-danger">
{{ $message }}
</span>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for=""></label>
<button class="btn btn-primary float-center" style="width:140px; height:35px;">
<span class="mdi mdi-plus-circle">
</span>
&nbsp;
Update
</button>
&nbsp;
&nbsp;
<a class="btn btn-danger float-center" href="{{route('catagory-index')}}" style="width:140px; height:35px;">
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
