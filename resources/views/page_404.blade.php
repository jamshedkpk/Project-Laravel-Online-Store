<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Document</title>
<!-- Jquery-->
<script src="{{asset('frontend/jquery.js')}}"></script>
<!-- Fontawesome Icons-->
<script src="{{asset('frontend/all.min.js')}}"></script>
<!-- Bootstrap from app.css-->  
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('template_admin/assets/js/sweetalert.min.js')}}"></script>

<!-- <script src="{{asset('frontend/popper.min.js')}}"></script> -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
<style>
.error-404 {
margin: 0 auto;
text-align: center;
color:red;
}
.error-404 .error-code {
bottom: 60%;
color: #4686CC;
font-size: 96px;
line-height: 100px;
font-weight: bold;
}
.error-404 .error-desc {
font-size: 12px;
color: #647788;
}
.error-404 .m-b-10 {
margin-bottom: 10px!important;
}
.error-404 .m-b-20 {
margin-bottom: 20px!important;
}
.error-404 .m-t-20 {
margin-top: 20px!important;
}
</style>
</head>
<body>
<div class="container mt-10">
<div class="row">
<div class="col-md-10 offset-1">
<div class="error-404">
<div class="error-code m-b-10 m-t-20">404 <i class="fa fa-warning"></i></div>
<h2 class="font-bold">
@if($error)
{{ $error }}
@endif
</h2>
<hr>
<!-- <a class=" login-detail-panel-button btn" href="http://vultus.de/"> -->
<a href="{{route('home')}}" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Go back to Homepage</a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>