@extends('layouts.frontend.app')
@section('content')
<style>
.table tr th, .table tr td
{
text-align:center;
}
</style>
<div class="container " style="margin-top:10px;">
<form action="{{route('place-order')}}">
<div class="row">
<div class="col-md-6">
<div class="card">
<h3 class="text-primary text-center">
{{ __('message.basic_detail') }}
</h3>
<div class="card-body">
<!-- Ajax error will by displayed here-->
<div id="error">

</div>
<!--End of Ajax error will by displayed here-->
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="name">Name :</label>
<input type="text" value="{{ $user->username }}" name="name" id="name" class="form-control"/>
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
<input type="text" name="email" value="{{ $user->useremail }}" id="email" class="form-control"/>
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
<label for="country_iso2">Country:</label>
<select name="country_iso2" id="country_iso2" class="form-control form-select country">
@foreach($countries as $country)
<option value="{{ $country->iso2 }}" {{ $country->iso2==$user->usercountry ? 'selected' : ''}} >
{{ $country->name }}
</option>
@endforeach
</select>
@error('country_iso2')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="state_iso2">State :</label>
<select name="state_iso2" id="state_iso2" class="form-control form-select states">
</select>
@error('state_iso2')
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
<label for="city_iso2">City :</label>
<select name="city_iso2" id="city_iso2" class="form-control form-select cities">
<option value="0">Please Select A City</option>

</select>
@error('city_iso2')
<strong class="text-danger">
{{ $message }}
</strong>
@enderror
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="mobile">Mobile :</label>
<input type="text" name="mobile" id="mobile" value="{{ $user->usermobile }}" class="form-control"/>
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
<textarea class="form-control" name="address" id="address"  cols="30" rows="10">
{{ $user->useraddress }}
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
<div class="col-md-6">
<div class="card">
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
@if(!$cartItems->isEmpty())
@foreach($cartItems as $index=>$item)
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
<h4 class="mt-5 text-success text-end">
{{ __('message.total_price') }}    
: {{ $totalPrice }}</h4>

<button class="btn btn-success w-100">Place Order</button>

</div>
</div>
</div>
</div>
</form>
</div>
@endsection

@section('extra-js')
<script>
// Start of JQuery
$(document).ready(function(){


// Start of call function for country
$('body').delegate('.country','change',function(){
var countryiso2=$(this).val();
$('.states').empty();
$('.cities').empty();
searchStates(countryiso2);
searchCities(countryiso2);
});
// End of call function for country

// Start of call function for country
$('body').delegate('.country','focusout',function(){
var countryiso2=$(this).val();
$('.states').empty();
$('.cities').empty();
searchStates(countryiso2);
searchCities(countryiso2);
});
// End of call function for country


// Start of search function for states through ajax
function searchStates(countryiso2)
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of Ajax Call for fetching states
$.ajax({
// Url where you want to send data
url: "/user-state",
// Method of sending data
type: 'GET',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"_token": token,
"countryiso2":countryiso2,
},
success:function(response)
{
$count=response.states.length;
$i=0;
for($i=0;$i<$count;$i++)
{
let name=response.states[$i]['name'];
let iso2=response.states[$i]['iso2'];
$('.states').prepend('<option value="'+ iso2 +'" {{ $user->userstate=="'+ iso2 +'" ? "selected" : "" }}>'+ name +'</option>');
}
},
error:function(jqXHR, exception)
{
var msg = '';
if (jqXHR.status === 0) {
msg = 'Not connect.\n Verify Network.';
} else if (jqXHR.status == 404) {
msg = 'Requested page not found. [404]';
} else if (jqXHR.status == 500) {
msg = 'Internal Server Error [500].';
} else if (exception === 'parsererror') {
msg = 'Requested JSON parse failed.';
} else if (exception === 'timeout') {
msg = 'Time out error.';
} else if (exception === 'abort') {
msg = 'Ajax request aborted.';
} else {
msg = 'Unknown error has occured!';
}
$('#error').prepend('<div class="alert alert-danger text-center text-light bg-danger alert-dismissible" role="alert">'+
msg
+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">'+
'</button>'+'</div>');
}
// End of error message

});
// End of Ajax Call for fetching states

}
// End of search function for states through ajax

// Start of search function for city through ajax
function searchCities(countryiso2)
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of Ajax Call for fetching states
$.ajax({
// Url where you want to send data
url: "/user-city",
// Method of sending data
type: 'GET',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"_token": token,
"countryiso2":countryiso2,
},
success:function(response)
{
$count=response.cities.length;
$i=0;
for($i=0;$i<$count;$i++)
{
let name=response.cities[$i]['name'];
$('.cities').prepend('<option  value="'+ name +'">'+ name +'</option>');
}
},
error:function(jqXHR, exception)
{
var msg = '';
if (jqXHR.status === 0) {
msg = 'Not connect.\n Verify Network.';
} else if (jqXHR.status == 404) {
msg = 'Requested page not found. [404]';
} else if (jqXHR.status == 500) {
msg = 'Internal Server Error [500].';
} else if (exception === 'parsererror') {
msg = 'Requested JSON parse failed.';
} else if (exception === 'timeout') {
msg = 'Time out error.';
} else if (exception === 'abort') {
msg = 'Ajax request aborted.';
} else {
msg = 'Unknown error has occured!';
}
$('#error').prepend('<div class="alert alert-danger text-center text-light bg-danger alert-dismissible" role="alert">'+
msg
+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">'+
'</button>'+'</div>');
}
// End of error message
});
// End of Ajax Call for fetching states

}
// End of search function for city through ajax


});
// End of JQuery
</script>
@endsection