@extends('admin.user.layout')
@section('content')
                <!-- Start of View Update Password-->
                <div class="tab-pane fade in active" id="tab2">
                    <form action="{{route('update-user-profile',$user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input name="name" value="{{$user->name}}" type="text" class="form-control">
                                    @error('name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input name="email" value="{{$user->email}}" type="text" class="form-control">
                                    @error('email')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Country:</label>
                                    <select name="country_iso2" id="country_iso2" class="form-control form-select country">
                                    <option value="0">Please Select A Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ country->iso2 }}">
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
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State:</label>
                                    <select name="state_iso2" id="state_iso2" class="form-control form-select states">
                                        <option value="0">Please Select A State</option>

                                    </select>
                                    @error('state_iso2')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City:</label>
                                    <select name="city_iso2" class="form-control form-select cities" id="city_iso2">
                                        <option value="0">Please Select A City</option>
                                    </select>
                                    @error('city_iso2')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address:</label>
                                    <input name="address" value="{{$user->address}}" type="text" class="form-control">
                                    @error('address')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile:</label>
                                    <input name="mobile" value="{{$user->mobile}}" type="text" class="form-control">
                                    @error('mobile')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                    
                            <div class="form-group">
                                    <label>Role:</label>
                                    <input name="role_id" value="{{$user->role->name}}" type="text" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <label>status:</label>
                                    <input name="status" value="{{$user->status==1 ? 'Active' : 'In Active' }}" type="text" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <a class="btn btn-danger btn-block" href="{{route('view-user-profile',$user->id)}}">
                                    <span class="fa fa-user"></span>
                                    &nbsp;
                                    View Profile
                                </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <button class="btn btn-danger btn-block" name="btnUpdateProfile">
                                    <span class="fa fa-edit"></span>
                                    &nbsp;
                                    Update Profile</button>
                            </div>
                            <div class="col-md-4 text-center">
                            <a class="btn btn-danger btn-block" href="{{route('homepage')}}">
                                    <span class="fa fa-home"></span>
                                    &nbsp;
                                    Back To Home</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of View Update Password-->
                    @if($message=Session::get('user-updated'))
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
@endsection
@section('extra-js')
<script>
// Start of JQuery
$(document).ready(function(){

// Start of clear all States and Cities when user click on any country
function clearStateCities()
{
$('.states').empty();
$('.cities').empty();    
}
// End Of clear all States and Cities when user click on any country

// Start of ajax call when user click any country
$('body').delegate('.country','change',function(){
// To prevent default action
event.preventDefault();
// To clear the states and cities
clearStateCities();
// Getting primary key of country
let countryiso2=$(this).val();
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
$('.states').prepend('<option value="'+ iso2 +'">'+ name +'</option>');
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



});
// End of ajax call when user click any country

});
// End of JQuery
</script>
@endsection