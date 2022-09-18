@extends('layouts.admin.app')
@section('content')
<style>
#countryPhoto
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
<h3 class="text-center">Welcome To The Country Section</h3>
<a href="{{route('country-create')}}" class="btn btn-primary">
<span class="mdi mdi-plus-circle">&nbsp;
</span>  
Add country</a>
</div>
</div>
<hr>
<div class="row">
<div class="col-md-10 offset-1">
@if(!$countries->isEmpty())
<table class="table" id="table">
<thead>
<tr>
<th>
S.No
</th>
<th>
Name
</th>
<th>
ISO
</th>
<th>
Delete
</th>
</tr>
</thead>
<tbody>
@foreach($countries as $index=>$country)
<tr>
<td>
{{ $index+1 }}
</td>
<td>
{{ $country->name }}
</td>
<td>
{{ $country->iso2 }}
</td>
<td>
<a href="{{route('country-delete',$country->iso2)}}">
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
<img class="img-responsive" src="{{asset('template_admin/assets/images/empty.png')}}" alt="" height="300px" width="800px;">
</div>
</td>
</tr>
</tbody>
</table>
@endif
</div>
</div>
</div>
</body>
@endsection

@section('extra-js')

@if($message=Session::get('country-deleted'))
<script>
swal({
title: "Good job!",
text: "{{ $message }}",
icon: "success",
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