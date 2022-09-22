<?php 
// Display cart items from a static function
use App\Http\Controllers\CartController;
$items=CartController::countCartProduct();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<button
class="navbar-toggler"
type="button"
data-mdb-toggle="collapse"
data-mdb-target="#navbarTogglerDemo01"
aria-controls="navbarTogglerDemo01"
aria-expanded="false"
aria-label="Toggle navigation"
>
<i class="fas fa-bars"></i>
</button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
<a class="navbar-brand" href="#">
<img src="{{asset('storage/images/logo.png')}}" class="img-thumbnail" height="30px;" width="30px;" alt="">
</a>
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item">
<!-- Show selected language -->
<select class="form-control form-select language" class="form-control form-select">
<option value="">
Select A Language
</option>
<option {{session()->has('locale')?(session()->get('locale')=='en'?'selected':''):''}} value="en">
    English
</option>
<option {{session()->has('locale')?(session()->get('locale')=='ur'?'selected':''):''}} value="ur">Urdu</option>
</select>
</li>
<!-- Change language through ajax request-->
<script>
$(document).ready(function(){
$('.language').change(function(){
var lang=$(this).val();
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of ajax
$.ajax
({
// Url where you want to send data
url: "/change/language",
// Method of sending data
type: 'POST',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"_token": token,
"lang":lang,
},
success:function(response)
{
location.reload();
}
});
// End of ajax

});
});
</script>
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('homepage')}}">
<strong>
Home    
</strong>
</a>
</li>
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('homepage')}}">
<strong>
Catagory    
</strong>
</a>
</li>
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('homepage')}}">
<strong>
Products    
</strong>
</a>
</li>
@guest
@if (Route::has('login'))
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('login')}}">
<strong>
SignIn    
</strong>
</a>
</li>
@endif

@if (Route::has('register'))
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('register')}}">
<strong>
Register    
</strong>
</a>
</li>
@endif
@else
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('view-user-profile',Auth::user()->id)}}">
<strong>
Profile    
</strong>
</a>
</li>
<li class="nav-item">
<a href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();" class="nav-link active" aria-current="page">
<strong>
Sign Out    
</strong>
</a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
@csrf
</form>
@endguest
<li class="nav-item">
<a class="nav-link active" aria-current="page" href="{{route('cart-index')}}">
<strong class="text-light">
<i class='fa fa-shopping-cart'></i>
Carts : 
&nbsp;
<span id="cartProducts">
</span>
</strong>
<script>
$(document).ready(function(){
countCartProducts();
// Start of searchProduct function
function countCartProducts()
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of ajax
$.ajax
({
// Url where you want to send data
url: "/cart/count",
// Method of sending data
type: 'GET',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"_token": token,
},
success:function(response)
{
$('#cartProducts').html(response.data);    
}
});
// End of ajax
}
// End of searchProduct function
});
</script>
</strong>
</a>
</li>

</ul>
<form method="post" action="{{route('product-search')}}" class="d-flex input-group w-auto">
@csrf
<input
type="search"
class="form-control"
placeholder="Search a Product Here"
aria-label="Search"
id="search",
name="search"
/>
<button
class="btn btn-outline-primary" 
type="submit"
data-mdb-ripple-color="dark" 
>
Search
</button>
</form> 
</div>
</div>
</nav>
@if($message=Session::get('search-error'))
<script>
swal({
title: "Warning !",
text: "{{ $message }}",
icon: "error",
timer:2000,  
button: "OK",
});
</script>
@endif

