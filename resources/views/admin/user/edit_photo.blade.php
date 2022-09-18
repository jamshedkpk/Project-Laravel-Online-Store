@extends('admin.user.layout')
@section('content')
<link href="{{asset('pluginPhotoSelector/dist/css/bootstrap-imageupload.css')}}" rel="stylesheet">
<style>
.imageupload {
margin: 20px 0;
}

</style>

<div class="container">
<form method="post" action="{{route('update-user-photo',$user->id)}}" enctype="multipart/form-data">
@csrf
@method('PUT')
<!-- bootstrap-imageupload. -->
<div class="imageupload panel panel-default">
<div class="panel-heading clearfix">
<h3 class="panel-title pull-left">Upload Image</h3>
</div>
<div class="file-tab panel-body">
<label class="btn btn-default btn-file">
<span>Browse</span>

<!-- The file is stored here. -->
<input type="file" name="photo">
</label>
<button type="button" class="btn btn-default">Remove</button>
</div>
@error('photo')
<span class="text-danger">
{{ $message }}
</span>
@enderror

<div class="url-tab panel-body">
<div class="input-group">
<input type="text" class="form-control hasclear" placeholder="Image URL">
<div class="input-group-btn">
<button type="button" class="btn btn-default">Submit</button>
</div>
</div>
<button type="button" class="btn btn-default">Remove</button>
<!-- The URL is stored here. -->
<input type="hidden" name="image-url">
</div>
</div>

<!-- bootstrap-imageupload method buttons. -->
<button type="button" id="imageupload-reset" class="btn btn-primary">Reset</button>
<button type="submit" class="btn btn-success">Submit</button>
</form>
</div>

<script src="{{asset('pluginPhotoSelector/dist/js/bootstrap-imageupload.js')}}"></script>

<script>
var $imageupload = $('.imageupload');
$imageupload.imageupload();


$('#imageupload-reset').on('click', function() {
$imageupload.imageupload('reset');
$(this).blur();
});
</script>
@endsection