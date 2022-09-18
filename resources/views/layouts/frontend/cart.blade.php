@extends('layouts.frontend.app')
@section('content')
<style>
.card
{
padding:5px;
}
</style>

<div class="container" style="margin-top:10px;">
<h3 class="text-center text-primary">
{{ __('message.cart_section') }}  
</h3>
<hr>
<div id="cartBody">

</div>

<div class="row">
<div class="col-md-4 offset-1">
<h3 class="text-end text-primary">
{{ __('message.total_price') }} : 
PKR
<span id="cart-price">
</span>  
</h3>
</div>
</div>

<div class="row">
<div class="col-md-8 offset-2">
<div class="card">
<div class="body">
<div class="row">
<div class="col-md-6">
<a class="btn btn-warning btn-block btn-lg w-100" href="{{ route('checkout-index') }}">
<i class="fa fa-shopping-cart"></i>
&nbsp;    
Proceed to Pay
</a>
</div>
<div class="col-md-6">
<a href="{{ route('homepage') }}" class="btn btn-danger btn-block btn-lg w-100">
<i class="fa fa-home"></i>
&nbsp;  
Homepage</a>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
@endsection


@section('extra-js')
<script>
// Start of jquery
$(document).ready(function(){
searchRecord();
/* To search a record by ajax we can simply use window.location.reload()
function instead of the following complex code. 
But if you want to not refresh the page than you can write the code below.
In this wany we create a div where we want to display the code and then
attatch the code by prepend function of jquery. But recommended way is to 
use function of window.location.reload();
*/

//Start of search cart data throught ajax
function searchRecord()
{
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
// Start of ajax operation to search cart record
$.ajax
({
// URL from where we want to fetch data
url:"/cart/products",
// Type of request for fetching data
type:"GET",
// In which format we want to fetch data
dataType:'json',
// To clear cache
cache:false,
// Send csrf token for security purpose
data:{
  "_token":token
},
// If request is successfull
success:function(response)
{
// To count no of products in cart
var count=response['products'].length;
if(count>0)
{
// Running for loop to display data in html
var i=0;
for(i=0; i<count; i++)
{
// Store attributes in different variable
var id=response['products'][i]['id'];
var name=response['products'][i]['name'];
var photo=response['products'][i]['photo'];;
var price=response['products'][i]['selling_price'];
// To attach all fetched data with cartBody id
$('#cartBody').prepend(
'<div class="row">'
+
'<div class="col-md-8 offset-2">'
+
'<div class="card rounded-3 mb-4">'
+
'<div class="row d-flex justify-content-between align-items-center">'
+
'<div class="col-md-2 text-center">'
+
name
+
'</div>'
+
'<div class="col-md-2">'
+
'<img src="' + photo + '" height="60px;" style="border-radius:10px;"/>'
+
'</div>'
+
'<div class="col-md-2 text-center">'
+
'<input type="number" class="form-control form-control-sm qty" style="height:37px;" pid="' +id+ '" id="qty-'+id+'" min="1" max="20"/>'
+
'</div>'
+
'<div class="col-md-2 text-center">'
+
'<input type="text" value="'+price+'" pid="'+id+'" id="price-'+id+'" class="form-control price" />'
+
'</div>'
+
'<div class="col-md-2 text-center">'
+
'<input type="text" pid="'+id+'" id="total-'+id+'" class="form-control total"/>'
+
'</div>'
+
'<div class="col-md-1 text-center">'
+
'<a href="#" product_id="' + id + '" class="text-warning updateCartBtn" id="updatebtn">'
+
'<span class="fa fa-edit">'
+
'</span>'
+
'</a>'
+
'</div>'
+
'<div class="col-md-1 text-center">'
+
'<a href="#" product_id="' + id + '" class="text-danger deleteCartBtn" id="deletebtn">'
+
'<span class="fa fa-trash">'
+
'</span>'
+
'</a>'
+
'</div>'
+
'</div>'
+
'</div>'
+
'</div>'
+
'</div>'
+
'</div>'
);
}
// End of if count > 0
}
// If their is not data
else
{
$('#cartBody').html(
'<div class="row">'
+
'<div class="col-md-8 offset-2 text-center">'
+
'<h4 class="text-center text-danger">Your Cart Is Empty</h4>'
+
'<div class="img-thumbnail">'
+
'<img class="img-responsive" src="template_admin/assets/images/empty.png" height="300px;" width="600px;">'
+
'</div>'
+
'</div>'
+
'</div>'
)
}
}
});
}
//End of search cart data throught ajax


// Start to increase and decrease quantity of cart
// When use press any key then total price is the following
$("body").delegate(".qty","keypress",function(){
// Get product id throught attribute property
var pid=$(this).attr('pid');
// Get product quantity by defining a unique name by mixing id and pid
var quantity=$("#qty-"+pid).val();
// Get product price by defining a unique name by mixing id and pid
var price=$("#price-"+pid).val();
// Calculate total price of each product 
var total=(quantity*price);
$("#total-"+pid).val(total);
});

// When use mouse out then total price is the following
$("body").delegate(".qty","mouseout",function(){
var pid=$(this).attr('pid');
var quantity=$("#qty-"+pid).val();
var price=$("#price-"+pid).val();
var total=(quantity*price);
$("#total-"+pid).val(total);
});

// End to increase and decrease quantity of cart

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
// Display success message of delete record
swal({
title: "Deleted Successfully!",
text: data['cart-product-deleted'],
icon: "success",
timer:2000,  
button: "OK",
});
// To make cartBody empty before fetching new data
$('#cartBody').empty();
// To fetch data after delete product from cart
searchRecord();
countCartProducts();
cartTotalPrice();

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

// Start of update cart product through ajax
$('body').delegate('.updateCartBtn','click',function(){
event.preventDefault();

var pid=$(this).attr('product_id');
var quantity=$("#qty-"+pid).val();
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
// To make cartBody empty before fetching new data
$('#cartBody').empty();
// To fetch data after delete product from cart
searchRecord();
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
}
// End of cartTotalPrice function
// End of calculate cart total price

});
// End of jquery
</script>
@endsection