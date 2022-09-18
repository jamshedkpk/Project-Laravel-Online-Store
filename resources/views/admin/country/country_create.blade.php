@extends('layouts.admin.app')
@section('content')
<div class="container">
<h3 class="text-center">
Welcome To The Country Section
</h3>
<hr>
<div class="row">
<div class="col-md-4 offset-4">
<form method="post" action="{{route('country-store')}}">
@csrf
<button class="btn btn-primary" type="submit" name="submit" value="submit">
Load Countries From  API
</button>
</form>
</div>
</div>
</div>
@endsection