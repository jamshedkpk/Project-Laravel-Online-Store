@extends('layouts.frontend.app')
@section('content')
<style>

.card{border:none;
}
.product{
    background-color: #eee;
    padding:25px;
}
.brand{font-size: 13px}
.act-price{color:red;font-weight: 700}
.dis-price{text-decoration: line-through}
.about{font-size: 14px}
.color{margin-bottom:10px}
label.radio{cursor: pointer}
label.radio input{position: absolute;top: 0;left: 0;visibility: hidden;pointer-events: none}
label.radio span{padding: 2px 9px;border: 2px solid #ff0000;display: inline-block;color: #ff0000;border-radius: 3px;text-transform: uppercase}
label.radio input:checked+span{border-color: #ff0000;background-color: #ff0000;color: #fff}
.btn-danger{background-color: #ff0000 !important;border-color: #ff0000 !important}
.btn-danger:hover{background-color: #da0606 !important;border-color: #da0606 !important}
.btn-danger:focus{box-shadow: none}
.cart i{margin-right: 10px}
</style>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    @if($product)
                    <div class="col-md-4">
                    <img id="main-image" src="{{ asset('storage/productPhoto/'.$product->photo) }}" height="100%"/>
                    </div>
                    <div class="col-md-8">
                        <div class="product">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div>
                                @if($product->quantity>0)
                                 <i class="fa fa-shopping-cart text-success"></i>
                                 @else
                                 <i class="fa fa-shopping-cart text-danger"></i>
                                 @endif                                 
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Orianz</span>
                                <h3 class="text-uppercase">
                                <strong>{{$product->name}}</strong>
                                </h3>
                                <h5 class="text-uppercase text-danger">
                                <strong>
                                <s>
                                Orignal Price :    
                                {{$product->original_price}}
                                </s>
                                </strong>
                                </h5>
                                <h5 class="text-uppercase text-success">
                                <strong>Selling Price : {{$product->selling_price}}</strong>
                                </h5>                            
                            </div>
                            <p class="about">
                            {{ $product->description }}    
                            </p>
                            <div class="text-center">
                            @if($product->quantity>0)
                            <button type="button" class="btn btn-success text-uppercase btnAddProduct mr-2 px-4" product_id="{{$product->id}}"> <i class="fa fa-shopping-cart"></i> 
                            &nbsp;
                            Add To Cart
                            </button>
                            @else
                            <h4 class="text-danger text-center">Sorry The Product Is Out Of Stock</h4>
                            @endif
                            <a href="{{route('homepage')}}" class="btn btn-danger text-uppercase mr-2 px-4"> <i class="fa fa-home"></i>
                            &nbsp;
                            Home Page</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-js')

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

@endsection