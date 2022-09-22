@extends('layouts.frontend.app')
@section('content')
<style>
.container
{
margin-top:30px;
}
.row
{
text-align:center;
}
.col-md-2
{
text-align:center;
}
</style>
<div class="container product_data">
<div class="row">
<div class="col-md-10 offset-1">
<!-- Start of card-->
<div class="card cartItems">
<div class="card-header bg-primary">
<div class="card-title">
<h3 class="text-light text-center">
{{ __('message.cart_section') }}
</h3>
</div>
</div>
<div class="card-body">
<div class="row">
<div class="col-md-2">
<strong class="text-primary">
{{ __('message.cart_s.no') }}
</strong>
</div>
<div class="col-md-2">
<strong class="text-primary">
{{ __('message.cart_name') }}
</strong>
</div>
<div class="col-md-2">
<strong class="text-primary">
{{ __('message.cart_quantity') }}
</strong>
</div>
<div class="col-md-2">
<strong class="text-primary">
{{ __('message.cart_price') }}
</strong>
</div>
<div class="col-md-2">
<strong class="text-primary">
{{ __('message.cart_total') }}
</strong>
</div>
<div class="col-md-1">
<strong class="text-primary">
{{ __('message.cart_update') }}
</strong>
</div>
<div class="col-md-1">
<strong class="text-primary">
{{ __('message.cart_delete') }}
</strong>
</div>
</div>
<hr>
@foreach($products as $index=>$product)
<div class="row product_data">
<div class="col-md-2">
{{ $index+1 }}
</div>
<div class="col-md-2">
{{ $product->name }}
</div>
<div class="col-md-2">
<input type="number" class="form-control quantity" min="1"  max="10"/>
</div>
<div class="col-md-2">
<input type="text" class="form-control price text-center" value="{{ $product->selling_price }}" readonly>
</div>
<div class="col-md-2">
<input type="text" class="form-control total text-center" value="{{ $product->selling_price }}" readonly>
</div>
<div class="col-md-1">
<button class="btn btn-warning updateCartBtn" product_id="{{ $product->id }}">
<span class="fa fa-edit text-light"></span>
</a>
</div>
<div class="col-md-1">
<button product_id="{{ $product->id }}" class="btn btn-danger deleteCartBtn">
<span class="fa fa-trash text-light"></span>
</button>
</div>
<hr>
</div>
@endforeach
</div>

<div class="card-footer bg-primary">
<div class="row">
<div class="col-md-12">
<h3 class="text-end text-light">
{{ __('message.total_price') }} : 
PKR
<span id="cart-price">
</span>  
</h3>
</div>

<div class="row">
<div class="col-md-6">
<a class="btn btn-warning btn-block btn-lg w-100" href="{{ route('checkout-index') }}">
<i class="fa fa-shopping-cart"></i>
&nbsp;    
{{ __('message.cart_btn_proceed') }}
</a>
</div>
<div class="col-md-6">
<a href="{{ route('homepage') }}" class="btn btn-danger btn-block btn-lg w-100">
<i class="fa fa-home"></i>
&nbsp;  
{{ __('message.cart_btn_homepage') }}
</a>
</div>
</div>
</div>

</div>
</div>    
<!-- End of card-->
</div>
</div>
</div>
@endsection
@section('extra-js')
<script>
// Start of JQuery
$(document).ready(function(){
// Start of When user increase or decrease quantity
$('body').delegate('.quantity','change',function(e){
    // Stop the default action
e.preventDefault();
// Get quantity of product
var quantity=$(this).val();
// Get price nearest to .product_data
var price=$(this).closest('.product_data').find('.price').val();
// Calculate total price 
var total=(quantity*price);
// Set price to total 
$(this).closest('.product_data').find('.total').val(total);
cartTotalPrice();

});
// End of When user increase or decrease quantity

// Start of calculate cart total price
cartTotalPrice();
// Start of cartTotalPrice function
function cartTotalPrice()
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");

// Start of ajax
$.ajax({
// Url where you want to send data
url: "/cart/price",
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
$total=response['cart-total-price'];
$('#cart-price').html($total);
}
// End of ajax
});
// End of cartTotalPrice function
}
// End of calculate cart total price

//Start to delete a product from cart by ajax

// When delete button is clicked
$('body').delegate('.deleteCartBtn','click',function(){
// To stop its current behraviour
event.preventDefault();
// Store id of product from attribute value in jquery
var pid=$(this).attr('product_id');
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of ajax operation to delete a product from cart
$.ajax(
{
// Url where you want to send data
url: "/cart/delete/"+pid,
// Method of sending data
type: 'DELETE',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"id": pid,
"_token": token,
},
// Response of data
success: function (data){
// To reload the cart section only
countCartProducts();
cartTotalPrice();
// To refresh only cart section
$('.cartItems').load(location.href + " .cartItems");
// Display success message of delete record
swal({
title: "Deleted Successfully!",
text: data['cart-product-deleted'],
icon: "success",
timer:2000,  
button: "OK",
});

},
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
// End of ajax operation to delete a product from cart
});
// End to delete a product from cart by ajax

countCartProducts();
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
cartTotalPrice();
}
});
// End of ajax
}
// End of countCartProducts function

// Start of update cart product through ajax
$('body').delegate('.updateCartBtn','click',function(){
event.preventDefault();

var pid=$(this).attr('product_id');
var quantity=$(this).closest('.product_data').find('.quantity').val();
updateCartProduct(pid,quantity);
function updateCartProduct(pid,quantity)
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
$.ajax
({
// Url where you want to send data
url: "/cart/update/"+pid,
// Method of sending data
type: 'PUT',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"id": pid,
"_token": token,
"quantity":quantity,
},
// Response of data
success: function (response){
// Display success message of updated record
swal({
title: "Updated Successfully!",
text: response['cart-product-updated'],
icon: "success",
timer:2000,  
button: "OK",
});
countCartProducts();
cartTotalPrice();
},
// Start of error message
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
}
//updateproduct(pid,quantity,price,total);

});
// End of update cart product through ajax


});
// End of JQuery
</script>
@endsection