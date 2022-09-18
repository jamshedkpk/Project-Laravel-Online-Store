@extends('layouts.frontend.app')
@section('content')
<div class="container" style="margin-top:10px;">
<div class="row text-center">
<div class="col-md-6 offset-3">
<strong class="text-success">
Total Amount : 
{{ $total }}
</strong>
</div>
</div>
<div class="row text-center">
<div class="col-md-6 offset-3">
<!-- Start of paypall button-->
<label for="">Email Address:</label>
 sb-6xla4720787207@personal.example.com
 <br>
<label for="">Password:</label>
  MoDG=0Y8

<div id="smart-button-container">
<div style="text-align: center;">
<div id="paypal-button-container">
</div>
</div>
</div>
<!-- End of paypall button-->
</div>
</div>
<hr>
</div>
@endsection
@section('extra-js')
<script src="https://www.paypal.com/sdk/js?client-id=Acp33mOMFyAcwM_Zx5KN8TqOptkaLjgkJ1YIQEIg21MhAsT93rha8nhy94lQJHsaTL2sQBsVf9kuVm7E" data-sdk-integration-source="button-factory"></script>
<script>
function initPayPalButton() {
paypal.Buttons({
style: {
shape: 'pill',
color: 'gold',
layout: 'horizontal',
label: 'paypal',
},

createOrder: function(data, actions) {
return actions.order.create({
purchase_units: [{"amount":{"currency_code":"USD","value":'{{ $total }}'}}]
});
},

onApprove: function(data, actions) {
return actions.order.capture().then(function(orderData) {

// Full available details
console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

// Show a success message within this page, e.g.
const element = document.getElementById('paypal-button-container');
element.innerHTML = '';
element.innerHTML = '<h3>Thank you for your payment!</h3>';
var orderid='{{ $orderid }}';
// store csrf token in token variable
var token = $("meta[name='csrf-token']").attr("content");
$.ajax
({
// Url where you want to send data
url: "/payment/update/" + orderid,
// Method of sending data
type: 'PUT',
// Format of data
dataType:'json',
// To clear cache
cache:false,
// Data which you want to send
data: {
"id": orderid,
"_token": token,
},
});



// Or go to another URL:  actions.redirect('thank_you.html');

});
},

onError: function(err) {
console.log(err);
}
}).render('#paypal-button-container');
}
initPayPalButton();
</script>
@endsection