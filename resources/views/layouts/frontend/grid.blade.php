<style>
* {
padding: 0;
margin: 0;
box-sizing: border-box;
font-family: 'Montserrat', sans-serif
}

body {
background-color: #f0efed;
}

.container {
margin: 30px auto
}
.container .product-item
{
min-height: 100px;
border: none;
overflow: hidden;
position: relative;
border-radius: 0
}

.container .product-item .product {
width: 100%;
height: 200px;
position: relative;
overflow: hidden;
cursor: pointer
}

.container .product-item .product img {
width: 100%;
height: 100%;
object-fit: cover;
}

.container .product-item .product .icons .icon {
width: 40px;
height: 40px;
background-color: #fff;
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
transition: transform 0.6s ease;
transform: rotate(180deg);
cursor: pointer
}

.container .product-item .product .icons .icon:hover {
background-color: #10c775;
color: #fff
}

.container .product-item .product .icons .icon:nth-last-of-type(3) {
transition-delay: 0.2s
}

.container .product-item .product .icons .icon:nth-last-of-type(2) {
transition-delay: 0.15s
}

.container .product-item .product .icons .icon:nth-last-of-type(1) {
transition-delay: 0.1s
}

.container .product-item:hover .product .icons .icon {
transform: translateY(-60px)
}

.container .product-item .tag {
text-transform: uppercase;
font-size: 0.75rem;
font-weight: 500;
position: absolute;
top: 10px;
left: 20px;
padding: 0 0.4rem;
}

.container .product-item .title {
font-size: 0.95rem;
letter-spacing: 0.5px
}

.container .product-item .fa-star {
font-size: 0.65rem;
color: #ff0000;
}

.container .product-item .price {
margin-top: 10px;
margin-bottom: 10px;
font-weight: 600;
}

.fw-800 {
font-weight: 800;
}

.bg-green {
background-color: #208f20 !important;
color: #fff;
}

.bg-black {
background-color: #1f1d1d;
color: #fff
}

.bg-red {
background-color: #bb3535;
color: #fff
}
.product img
{
border-radius:10px;
}
.btn-primary:hover
{
background-color:green;
}
</style>
<link rel="stylesheet" href="">
<script src=""></script>
<!-- Start of Latest Product-->
<div class="container bg-white">
&nbsp;
<h3 class="text-center text-primary">
{{ __('message.product_section') }}    
</h3>

<hr>
<div class="row">
<div class="col-md-2 mt-3">
<ul class="list-group">
<li class="list-group-item text-center text-primary"><strong>Catagories</strong></li>
@foreach($catagories as $catagory)
<li class="list-group-item ">
<a href="{{route('catagory-product',$catagory->id)}}" class="list-group-item  {{ Request::is('catagory/products/'.$catagory->id) ? 'active' : '' }}">
{{ $catagory->name }}    
</a>
</li>
@endforeach
</ul>

</div>
<div class="col-md-10">
@if(!$products->isEmpty())
<div class="row">
@foreach($products as $product)
<div class="col-lg-3 col-sm-6 d-flex flex-column align-items-center justify-content-center product-item my-3">
<!-- Redirect to detail product page-->
<div class="card">
<div class="card-body">
<div class="product"> 
<a href="{{url('product-detail/'.$product->slug,$product->id)}}" style="text-decoration:none;">
<img src="{{asset($product->photo)}}" height="200px;" class="img-responsive" alt="">
</a>
<ul class="d-flex align-items-center justify-content-center list-unstyled icons">
<a href="{{url('product-detail/'.$product->slug,$product->id)}}" style="text-decoration:none;">
<li class="icon bg-danger"><span class="fas fa-expand-arrows-alt text-white"></span></li>
</a>
<form method="post" action="{{route('wishlist-store')}}">
@csrf    
<button type="submit">
<li class="icon mx-3 bg-danger"><span class="far fa-heart text-white"></span></li>
</button>
</form>
<button type="button" class="btnAddProduct" product_id="{{ $product->id }}">
<li class="icon bg-danger"><span class="fas fa-shopping-bag text-white"></span></li>
</button>
</ul>
</div>
<h4 class="mt-2 text-center text-primary name">{{substr($product->name,0,14) }}</h4>
<div class="d-flex align-content-center justify-content-center"> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> <span class="fas fa-star"></span> </div>
<div class="price text-center text-success">Price : {{$product->selling_price}}</div>
<div class="price text-center text-danger">
<s>
Price : {{$product->original_price}}
</s>    
</div>
<button type="button" class="btn btn-primary w-100 btnAddProduct" product_id="{{ $product->id }}">Add To Cart</button>
</div>
</div>

</div>
@endforeach
</div>
{{ $products->links() }}
@else
<h4 class="text-center">No Data Were Found</h4>
<div class="img-thumbnail">
<img class="img-responsive" src="{{asset('template_admin/assets/images/empty.png')}}" alt="" height="300px" width="800px;">
</div>
@endif
</div>
</div>
</div>
<!-- End Start of Latest Product-->

@if($message=Session::get('rate-added'))
<script>
swal({
title: "Thanks You !",
text: "{{ $message }}",
icon: "success",
buttons: true,
dangerMode: true,
})
</script>
@endif

@if($message=Session::get('rate-updated'))
<script>
swal({
title: "Thank You !",
text: "{{ $message }}",
icon: "success",
timer:2000,  
button: "OK",
});
</script>
@endif

<script>
$(document).ready(function(){
// When we click btnAddProduct
$('body').delegate('.btnAddProduct','click',function(){
// Stop the default behaviour of the button
event.preventDefault();
// Take product id by attribute property in jquery
var pid=$(this).attr('product_id');
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
$.ajax
({
// Url where you want to send data
url: "/cart/store/",
// Method of sending data
type: 'POST',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: 
{
"id":pid,
"_token": token,
},
// Response of data If success
success: function (response)
{
// If user is not login
if(response['status']==201)
{
window.location.href = '/login'; 
}
// If product is already exist
else if(response['status']==202)
{
swal({
title: "Error Occured!",
text: response['product-exist'],
icon: "error",
timer:2000,  
button: "OK",
});
}
// If product is out of stock
else if(response['status']==203)
{
swal({
title: "Error Occured!",
text: response['product-not-available'],
icon: "error",
timer:2000,  
button: "OK",
});
}
// If product added successfully
else if(response['status']==200)
swal({
title: "Added Successfully!",
text: response['product-added-to-cart'],
icon: "success",
timer:2000,  
button: "OK",
});
countCartProducts();
},
// End of response of data If success
// If their is any error
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
// Display error message by swal
swal({
title: "Error Occured !",
text: msg,
icon: "error",
timer:2000,  
button: "OK",
});
// End of swal
}
// End of error message

});
});
});
// Start of CountCartProducts function
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
// End of countCartProducts function

</script>
