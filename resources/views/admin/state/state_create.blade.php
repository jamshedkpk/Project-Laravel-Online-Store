@extends('layouts.admin.app')
@section('content')
<div class="container">
<h3 class="text-center">
Welcome To The State Section
</h3>
<div class="row">
<div class="col-md-4 offset-4">
<form method="post" action="{{route('state-store')}}">
@csrf
<button class="btn btn-primary" type="submit" name="submit1" value="submit1">
Load All States
</button>
</form>
</div>
</div>
</div>
@endsection