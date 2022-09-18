@extends('admin.user.layout')
@section('content')
<div class="well">
            <div class="tab-content">

                <!-- Start of View Profile-->
                <div class="tab-pane fade in active" id="tab1">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name:</label>
                                <input name="name" value="{{$user->name}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email:</label>
                                <input name="email" value="{{$user->email}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Role:</label>
                                <input name="role" value="{{$user->role->name}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Country:</label>
                                <input name="country" value="{{$user->country ? $user->country->name:''}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>State:</label>
                                <input name="state" value="{{$user->state ? $user->state->name:''}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>City:</label>
                                <input name="city" value="{{$user->city ? $user->city->name:''}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile:</label>
                                <input name="mobile" value="{{$user->mobile}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>status:</label>
                                <input name="status" value="{{$user->status==1 ? 'Active' : 'In Active' }}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address:</label>
                                <input name="address" value="{{$user->address}}" type="text" class="form-control text-center" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of View Profile-->
            </div>

        </div>
@endsection