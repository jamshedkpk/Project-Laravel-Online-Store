@extends('layouts.admin.app')
@section('content')
<style>
.table tr th, .table tr td
{
text-align:center;
}
</style>
<div class="container " style="margin-top:10px;">
<div class="row">
<div class="col-md-12">
<div class="card">
<h3 class="text-light text-center">Basic Detail</h3>
<div class="card-body">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="name">Name :</label>
<input type="text" value="{{ $user->name }}" name="name" id="name" class="form-control" readonly style="background-color:red;"/>
@error('name')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="email">Email :</label>
<input type="text" name="email" value="{{ $user->email }}
" id="email" class="form-control"readonly style="background-color:red;" />
@error('email')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="country">Country :</label>
<input class="form-control" value="{{$user->country->name}}" type="text"readonly style="background-color:red;" >
@error('country')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="city">City :</label>
<input type="text" name="city" id="city" value="{{ $user->city->name }}" class="form-control" readonly style="background-color:red;"/>
@error('city')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="state_id">City :</label>
<input type="text" name="city_id" id="city_id" value="{{ $user->state->name }}" class="form-control" readonly style="background-color:red;" />
@error('state')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="mobile">Mobile :</label>
<input type="text" name="mobile" id="mobile" value="{{ $user->mobile }}" class="form-control" readonly style="background-color:red;"/>
@error('mobile')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="address">Address :</label>
<textarea class="form-control" name="address" id="address"  cols="30" rows="10" readonly style="background-color:red;">
{{ $user->address }}
</textarea>
@error('address')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-12">
<div class="card">
<h3 class="text-center text-light">Order Detail</h3>
<div class="card-body">
<table class="table table-bordered">
<thead>
<tr>
<th>
S.No
</th>
<th>
Name
</th>
<th>
Image
</th>
<th>
Quantity
</th>
<th>
Price
</th>
</tr>
</thead>
<tbody>
@if(!$orders->isEmpty())
@foreach($orders as $index=>$item)
<tr>
<td>
{{ $index+1 }}    
</td>
<td>
{{ $item->productname }}
</td>
<td>
<img src="{{asset($item->productphoto)}}" alt="Not Available" height="60px" width="60px;">
</td>
<td>
{{ $item->quantity }}
</td>
<td>
{{ $item->total }}
</td>
</tr>
@endforeach
@else
<h4 class="text-center">No Data Were Found</h4>
<div class="img-thumbnail text-center">
<img class="img-responsive" src="{{asset('template_admin/assets/images/empty.png')}}" alt="" height="300px" width="400px;">
</div>
@endif
</tbody>
</table>
<br>
<form method="post" action="{{route('update-order-status',$orderid)}}" >
@csrf
@method('PUT')
<select name="status" id="status" class="form-control form-select">
<option value="null">Select An Option</option>
<option value="0">
Pending
</option>
<option value="1">
Shipped
</option>
<option value="2">
Delivered
</option>
</select>
@error('status')
<span class="text-danger">
{{ $message }}
</span>
@enderror
<br>
<h4 class="text-success text-end">Total Price : {{ $totalorder }}</h4>
<button class="btn btn-success w-100" type="submit">
<strong>
Update Status
</strong>    
</button>
</form>

</div>
</div>
</div>
</div>
</div>
@endsection