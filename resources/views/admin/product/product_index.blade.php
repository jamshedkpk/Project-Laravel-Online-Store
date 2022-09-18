@extends('layouts.admin.app')
@section('content')
<style>
#productPhoto
{
height:80px !important;
width: 100px !important;
border:1px solid white !important;
border-radius:10px !important;
}
</style>

<div class="container mt-5">
<div class="row">
<div class="col-md-10 offset-1">
<h3 class="text-center">Welcome To The Product Section</h3>
<a class="btn btn-primary float-right" href="{{ route('product-create') }}">
<span class="mdi mdi-plus-circle">&nbsp;
</span>
Add Product
</a>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-10 offset-1">
@if(!$products->isEmpty())
<table id="table" class="table table-bordered">
<thead>
<tr>
<th>
S.No
</th>
<th>
Name
</th>
<th>
Catagory
</th>
<th>
Original Price
</th>
<th>
Selling Price
</th>
<th>
Photo
</th>
<th>
Quantity
</th>
<th>
slug
</th>
<th>
Status
</th>
<th>
Update
</th>
<th>
Delete
</th>
</thead>
<tbody>
@foreach($products as $index=>$product)
<tr>
<td>
{{ $index+1 }}
</td>
<td>
{{ $product->name }}
</td>
<th>
{{ $product->catagory->name }}
</th>
<td>
{{ $product->original_price }}
</td>
<td>
{{ $product->selling_price }}
</td>
<td>
<img id="productPhoto" src="{{asset($product->photo)}}" alt="">
</td>
<td>
{{ $product->quantity }}
</td>
<td>
{{ $product->slug }}
</td>
<td>
{{ $product->status==1? 'Available' : 'Out Of Stock' }}
</td>
<td>
<a href="{{route('product-edit',$product->id)}}">
<span class="mdi mdi-table-edit">
</span>
</a>
</td>
<td>
<a href="{{route('product-delete',$product->id)}}">
<span class="mdi mdi-delete"></span>
</a>
</td>
</tr>
@endforeach
@else
<tr>
<td>
<h4 class="text-center">No Data Were Found</h4>
<div class="img-thumbnail">
<img  class="img-responsive" src="{{asset('template_admin/assets/images/empty.png')}}" alt="" height="300px" width="800px;">
</div>
</td>
</tr>
</tbody>
<tbody>
</table>
@endif
</div>
</div>
</div>
@endsection
@section('extra-js')
@if($message=Session::get('product-added'))
<script>
swal({
  title: "Good job!",
  text: "{{ $message }}",
  icon:"success",
  iconColor:'red',
  timer:2000,  
  button: "OK",
});
</script>
@endif

@if($message=Session::get('product-deleted'))
<script>
swal({
  title: "Good job!",
  text: "{{ $message }}",
  icon:"success",
  iconColor:'red',
  timer:2000,  
  button: "OK",
});
</script>
@endif

@if($message=Session::get('product-updated'))
<script>
swal({
  title: "Good job!",
  text: "{{ $message }}",
  icon:"success",
  iconColor:'red',
  timer:2000,  
  button: "OK",
});
</script>
@endif

<script>
$(document).ready(function(){
$('#table').DataTable({
'responsive':true,
});
});
</script>
@endsection