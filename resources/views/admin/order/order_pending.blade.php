@extends('layouts.admin.app')
@section('content')
<div class="container mt-5">
<div class="row">
<div class="col-md-10 offset-1">
<h3 class="text-center">Welcome To The Pending Orders</h3>
<a class="btn btn-primary float-right" href="{{route('order-index')}}">
<span class="mdi mdi-plus-circle">&nbsp;
</span>
All Orders
</a>
<a class="btn btn-primary float-right" href="{{route('order-pending')}}">
<span class="mdi mdi-plus-circle">&nbsp;
</span>
Orders Pending
</a>
<a class="btn btn-primary float-right" href="{{route('order-shipped')}}">
<span class="mdi mdi-plus-circle">&nbsp;
</span>
Orders Shipped
</a>
<a class="btn btn-primary float-right" href="{{route('order-delivered')}}">
<span class="mdi mdi-plus-circle">&nbsp;
</span>
Orders Delivered
</a></div>
</div>
<hr>
<div class="row">
<div class="col-md-10 offset-1">
@if(!$orders->isEmpty())
<table id="table" class="table table-bordered">
<thead>
<tr>
<th>
S.No
</th>
<th>
Token
</th>
<th>
Date
</th>
<th>
Total Price
</th>
<th>
Status
</th>
<th>
Views
</th>
</thead>
<tbody>
@foreach($orders as $index=>$order)
<tr>
<td>
{{ $index+1 }}
</td>
<td>
{{ $order->token }}
</td>
<td>
{{ $order->date }}
</td>
<td>
{{ $order->total }}
</td>
<td>
{{ $order->status==0 ? 'Pending' : '' }}
</td>
<td>
<a href="{{route('order-detail',$order->id)}}" class="btn btn-success">View</a>
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

<script>
$(document).ready(function(){
$('#table').DataTable({
'responsive':true,
});
});
</script>
@endsection