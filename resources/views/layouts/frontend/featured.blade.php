  <!-- Caraousel Links-->
  <link rel="stylesheet" href="{{asset('frontend/carousel/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/carousel/assets/owl.theme.default.min.css')}}">
<!-- Start of Featured Products-->
  <div class="sy-5">
<div class="container">
<div class="row">
<h2 class="text-center text-primary">Featured Products</h2>
<hr>
<div class="owl-carousel owl-theme">
@foreach($products as $product)
<div class="item">
<div class="card">
<img src="{{asset($product->photo)}}" class="img-thumbnail" alt="">
</div>
<div class="card-body">
<h5 class="text-center text-primary">{{substr($product->name,0,14) }}</h5>
<strong class="float-start text-success">
RS : {{$product->selling_price}}
</strong>  
<strong class="float-end text-danger"><s>RS : {{$product->original_price}}</s></strong>
</div>
</div>
@endforeach
</div>
</div>
</div>
</div>
<!-- Start of Featured Products-->
<!-- Start of Trending Catagories-->
<div class="sy-5">
<div class="container">
<div class="row">
<h2 class="text-center text-primary">Trending Catagories</h2>
<hr>
<div class="owl-carousel owl-theme">
@foreach($catagories as $catagory)
<div class="item">
<div class="card">
<img src="{{asset($catagory->photo)}}" class="img-thumbnail" alt="">
</div>
<div class="card-body">
  <!-- Length of catagory not exceeds than 14-->
<h5 class="text-center text-primary">
  
{{substr ($catagory->name,0,14)}}</h5>
</div>
</div>
@endforeach
</div>
</div>
</div>
</div>
<!-- Start of Trending Catagories-->

<script src="{{asset('frontend/carousel/owl.carousel.min.js')}}"></script>
<script>
$('.owl-carousel').owlCarousel({
loop:true,
margin:10,
nav:true,
dots:false,
responsive:{
0:{
items:1
},
600:{
items:3
},
1000:{
items:4
}
}
})
</script>
