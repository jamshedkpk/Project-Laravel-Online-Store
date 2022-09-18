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
body
{    
font-family: 'Open Sans', sans-serif;
}    
</style>
</head>
<body>
@include('layouts.frontend.navbar')
@yield('content')
@yield('extra-js')
</body>
</html>
