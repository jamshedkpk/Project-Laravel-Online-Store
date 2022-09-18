@extends('admin.user.layout')
@section('content')
                <!-- Start of View Update Password-->
                <div class="tab-pane fade in active" id="tab2">
                    <form action="{{route('update-user-password',$user->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Old Password:</label>
                                    <input name="password_old"  type="password" class="form-control">
                                    @error('password_old')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>New Password:</label>
                                    <input name="password_new"  type="password" class="form-control">
                                    @error('password_new')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <label>Confirm Password:</label>
                                    <input name="password_new_confirmation"  type="password" class="form-control">
                                    @error('password_new_confirmation')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <a class="btn btn-danger btn-block" href="{{route('view-user-profile',$user->id)}}">
                                    <span class="fa fa-user"></span>
                                    &nbsp;
                                    View Profile
                                </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <button class="btn btn-danger btn-block" name="btnUpdateProfile">
                                    <span class="fa fa-edit"></span>
                                    &nbsp;
                                    Update Password</button>
                            </div>
                            <div class="col-md-4 text-center">
                            <a class="btn btn-danger btn-block" href="{{route('homepage')}}">
                                    <span class="fa fa-home"></span>
                                    &nbsp;
                                    Back To Home</a>
                            </div>
                        </div>
                   
                    </form>
                </div>
                <!-- End of View Update Password-->
@if($message=Session::get('invalid_password'))
<script>
swal({
  title: "Error Has Occured!",
  text: "{{ $message }}",
  icon:"error",
  iconColor:'red',
  timer:2000,  
  button: "OK",
});
</script>
@endif

@if($message=Session::get('user-password-updated'))
<script>
swal({
  title: "Good job!",
  text: "{{ $message }}",
  icon:"success",
  iconColor:'red',
  timer:2000,  
  button: "OK",
});
</script>
@endif

@endsection
