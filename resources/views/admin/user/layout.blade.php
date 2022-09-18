<script src="{{asset('frontend/jquery.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="{{asset('frontend/bootstrap3.css')}}" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/brands.min.css">
<script src="{{asset('frontend/bootstrap3.js')}}"></script>
<script src="{{asset('frontend/all.min.js')}}"></script>
<script src="{{asset('frontend/popper.min.js')}}"></script>
<script src="{{asset('template_admin/assets/js/sweetalert.min.js')}}"></script>

<!------ Include the above in your HEAD tag ---------->
<style>
    /* USER PROFILE PAGE */
    .card {
        margin-top: 20px;
        padding: 30px;
        background-color: rgba(214, 224, 226, 0.2);
        -webkit-border-top-left-radius: 5px;
        -moz-border-top-left-radius: 5px;
        border-top-left-radius: 5px;
        -webkit-border-top-right-radius: 5px;
        -moz-border-top-right-radius: 5px;
        border-top-right-radius: 5px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .card.hovercard {
        position: relative;
        padding-top: 0;
        overflow: hidden;
        text-align: center;
        background-color: #fff;
        background-color: rgba(255, 255, 255, 1);
    }

    .card.hovercard .card-background {
        height: 130px;
    }

    .card-background img {
        -webkit-filter: blur(25px);
        -moz-filter: blur(25px);
        -o-filter: blur(25px);
        -ms-filter: blur(25px);
        filter: blur(25px);
        margin-left: -100px;
        margin-top: -200px;
        min-width: 130%;
    }

    .card.hovercard .useravatar {
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
    }

    .card.hovercard .useravatar img {
        width: 100px;
        height: 100px;
        max-width: 100px;
        max-height: 100px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.5);
    }

    .card.hovercard .card-info {
        position: absolute;
        bottom: 14px;
        left: 0;
        right: 0;
    }

    .card.hovercard .card-info .card-title {
        padding: 0 5px;
        font-size: 20px;
        line-height: 1;
        color: #262626;
        background-color: rgba(255, 255, 255, 0.1);
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

    .card.hovercard .card-info {
        overflow: hidden;
        font-size: 12px;
        line-height: 20px;
        color: #737373;
        text-overflow: ellipsis;
    }

    .card.hovercard .bottom {
        padding: 0 20px;
        margin-bottom: 17px;
    }

    .btn-pref .btn {
        -webkit-border-radius: 0 !important;
    }
</style>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="card hovercard">
            <div class="card-background">
                <img class="card-bkimg" alt="" src="{{asset('storage/userPhoto/background.jpg')}}">
            </div>
            <div class="useravatar">
                <img alt="" src="{{ asset($user->photo)}}">
            </div>
            <div class="card-info"> <span class="card-title">
                    <strong>
                        Welcome To Mr : {{ $user->name }}
                    </strong>
                </span>
            </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a  class="btn {{ (request()->is('user/profile/'.$user->id)) ? 'btn-primary' : 'btn-default' }}"  href="{{route('view-user-profile',$user->id)}}">
                        <strong>
                        <span class="fa fa-user"></span>
                        <div class="hidden-xs">
                            View Profile
                        </div>
                </strong>
                </a>
            </div>
            <div class="btn-group" role="group">
                <a  class="btn {{ (request()->is('user/edit/profile/'.$user->id)) ? 'btn-primary' : 'btn-default' }}" href="{{route('edit-user-profile',$user->id)}}">
                    <strong>
                        <span class="fa fa-user-plus"></span>
                        <div class="hidden-xs">
                            Edit Profile
                        </div>
                    </strong>

                </a>
            </div>
            <div class="btn-group" role="group">
                <a  class="btn {{ (request()->is('user/edit/password/'.$user->id)) ? 'btn-primary' : 'btn-default' }}" href="{{route('edit-user-password',$user->id)}}">
                    <strong>
                        <span class="fa fa-lock"></span>
                        <div class="hidden-xs">
                            Edit Password
                        </div>
                    </strong>

                </a>
            </div>
            <div class="btn-group" role="group">
                <a  class="btn {{ (request()->is('user/edit/photo/'.$user->id)) ? 'btn-primary' : 'btn-default' }}" href="{{route('edit-user-photo',$user->id)}}">
                    <strong>
                        <span class="fa fa-archive"></span>
                        <div class="hidden-xs">
                            Edit Photo
                        </div>
                    </strong>

                </a>
            </div>
        </div>

        <div class="well">
            <div class="tab-content">
            @yield('content')
            </div>
        </div>
    </div>
</div>