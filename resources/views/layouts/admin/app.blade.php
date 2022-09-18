<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Corona Admin</title>
<!-- plugins:css -->
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/css/vendor.bundle.base.css')}}">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/jvectormap/jquery-jvectormap.css')}}">
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('template_admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
<!-- End plugin css for this page -->
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{asset('template_admin/assets/css/style.css')}}">
<!-- End layout styles -->
<link rel="shortcut icon" href="{{asset('template_admin/assets/images/favicon.png')}}" />
<style>
.form-control:focus{
color:white;
}
.dropdown-divider{
height:2px;
background-color: white;
}
.table tr td, .table tr th
{
text-align:center;
color:white;
}
.mdi-delete, .mdi-table-edit
{
font-size:20px !important;
color:red;
}
.mdi-table-edit
{
font-size:20px !important;
color:orange;
}
.mdi-home-variant
{
font-size:20px !important;
}
</style>

</head>
<body>
<div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{asset('home')}}"><img src="{{asset('template_admin/assets/images/logo.svg')}}" alt="logo" /></a>
      <a class="sidebar-brand brand-logo-mini" href="{{asset('home')}}"><img src="{{asset('template_admin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
      </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{asset('template_admin/assets/images/profile.png')}}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">
                    {{ Auth::user()->name }}
                  </h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{route('view-user-profile',Auth::user()->id)}}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger rounded-circle">
                      <i class="mdi mdi-settings text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">
                    Profile Settings</p>
                  </div>
                </a>
                <a href="{{route('edit-user-password',Auth::user()->id)}}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger rounded-circle">
                      <i class="mdi mdi-onepassword  text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Update Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                
                <a href="{{route('logout')}}" class="dropdown-item preview-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-danger rounded-circle">
                      <i class="mdi mdi-exit-to-app
 text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Log Out</p>
                  </div>
                </a>
             
              </div>
            </div>
          </li>
          <div class="dropdown-divider"></div>
          <li class="nav-item menu-items">
            <a class="nav-link    {{ Request::routeIs('dashboard') ? 'active bg-danger':'' }}" href="{{route('dashboard')}}">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-speedometer text-warning"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('user-index','user-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#user-ui" aria-expanded="false" aria-controls="user-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-account-plus text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage User</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('user-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('user-create')}}">
                  <strong>
                  Add User
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('user-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('user-index')}}">
                  <strong>
                  View Users
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('role-index','role-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#role-ui" aria-expanded="false" aria-controls="user-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-android text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage Role</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="role-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('role-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('role-create')}}">
                  <strong>
                  Add Role
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('role-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('role-index')}}">
                  <strong>
                  View Roles
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('catagory-index','catagory-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#catagory-ui" aria-expanded="false" aria-controls="catagory-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-wallet-giftcard text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage Catagory</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catagory-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('catagory-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('catagory-create')}}">
                  <strong>
                  Add Catagory
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('catagory-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('catagory-index')}}">
                  <strong>
                  View Catagories
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('product-index','product-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#product-ui" aria-expanded="false" aria-controls="product-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-cart
 text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage Product</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('product-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('product-create')}}">
                  <strong>
                  Add Product
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('product-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('product-index')}}">
                  <strong>
                  View Product
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>
 
          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('order-index') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#order-ui" aria-expanded="false" aria-controls="order-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-subway
 text-warning">
                </i>
              </span>
              <strong class="menu-title text-light">Manage Order</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('order-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('order-index')}}">
                  <strong>
                  View Orders
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('country-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#country-ui" aria-expanded="false" aria-controls="country-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-earth
 text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage Country</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="country-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('country-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('country-create')}}">
                  <strong>
                  Add Country
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('country-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('country-index')}}">
                  <strong>
                  View Countries
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link {{Request::routeIs('state-create') ? 'bg-primary' : ''}}" data-bs-toggle="collapse" href="#state-ui" aria-expanded="false" aria-controls="state-ui">
              <span class="menu-icon bg-danger">
                <i class="mdi mdi-google-maps
 text-warning"></i>
              </span>
              <strong class="menu-title text-light">Manage States</strong>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="state-ui">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::routeIs('state-create') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('state-create')}}">
                  <strong>
                  Add State
                  </strong>
                  </a>
                </li>
                <li class="nav-item {{Request::routeIs('state-index') ? 'active bg-danger' : '' }}"> 
                  <a class="nav-link" href="{{route('state-index')}}">
                  <strong>
                  View States
                  </strong>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->



      <div class="container-fluid page-body-wrapper">
<!-- partial:partials/_navbar.html -->
<nav class="navbar p-0 fixed-top d-flex flex-row">
<div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
<a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('template_admin/assets/images/logo-mini.svg')}}" alt="logo" /></a>
</div>
<div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
  <span class="mdi mdi-menu"></span>
</button>
<ul class="navbar-nav w-100">
  <li class="nav-item w-100">
    <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
      <input type="text" class="form-control" placeholder="Search products" style="background-color:white;color:black;">
    </form>
  </li>
</ul>
<ul class="navbar-nav navbar-nav-right">
  <li class="nav-item dropdown d-none d-lg-block">
    <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-bs-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
      <h6 class="p-3 mb-0">Projects</h6>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-file-outline text-primary"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">Software Development</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-web text-info"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">UI Development</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-layers text-danger"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">Software Testing</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <p class="p-3 mb-0 text-center">See all projects</p>
    </div>
  </li>
  <li class="nav-item dropdown border-left">
    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="mdi mdi-email"></i>
      <span class="count bg-success"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
      <h6 class="p-3 mb-0">Messages</h6>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <img src="{{asset('template_admin/assets/images/faces/face4.jpg')}}" alt="image" class="rounded-circle profile-pic">
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
          <p class="text-muted mb-0"> 1 Minutes ago </p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <img src="{{asset('template_admin/assets/images/faces/face2.jpg')}}" alt="image" class="rounded-circle profile-pic">
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
          <p class="text-muted mb-0"> 15 Minutes ago </p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <img src="{{asset('template_admin/assets/images/faces/face3.jpg')}}" alt="image" class="rounded-circle profile-pic">
        </div>
        <div class="preview-item-content">
          <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
          <p class="text-muted mb-0"> 18 Minutes ago </p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <p class="p-3 mb-0 text-center">4 new messages</p>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
      <div class="navbar-profile">
        <img class="img-xs rounded-circle" src="{{asset('template_admin/assets/images/faces/face15.jpg')}}" alt="">
        <p class="mb-0 d-none d-sm-block navbar-profile-name">
          {{ Auth::user()->name }}
        </p>
        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
    <a class="dropdown-item preview-item" href="{{route('view-user-profile',Auth::user()->id)}}">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-account-card-details text-success"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject mb-1">View Profile</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
         <a class="dropdown-item preview-item" href="{{route('edit-user-profile',Auth::user()->id)}}">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-face-profile text-warning"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject mb-1">Edit Profile</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item" href="{{route('edit-user-password',Auth::user()->id)}}">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-key-change text-danger"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject mb-1">Edit Password</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item" href="{{route('edit-user-photo',Auth::user()->id)}}">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-cards text-primary"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject mb-1">Edit Photo</p>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      
      <a class="dropdown-item preview-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-dark rounded-circle">
            <i class="mdi mdi-logout text-danger"></i>
          </div>
        </div>
        <div class="preview-item-content">
          <p class="preview-subject mb-1">Log Out</p>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
      </a>
      <div class="dropdown-divider"></div>
    </div>
  </li>
</ul>
<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
  <span class="mdi mdi-format-line-spacing"></span>
</button>
</div>
</nav>
<!-- partial -->
<div class="main-panel">
<div class="content-wraper">
@yield('content')
</div>
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('template_admin/assets/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('template_admin/assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{asset('template_admin/assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('template_admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('template_admin/assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
<script src="{{asset('template_admin/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('template_admin/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('template_admin/assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('template_admin/assets/js/misc.js')}}"></script>
<script src="{{asset('template_admin/assets/js/settings.js')}}"></script>
<script src="{{asset('template_admin/assets/js/todolist.js')}}"></script>
<script src="{{asset('template_admin/assets/js/sweetalert.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('template_admin/DataTables/datatables.min.css')}}">
<script src="{{asset('template_admin/DataTables/datatables.min.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('template_admin/assets/js/dashboard.js')}}"></script>
<!-- End custom js for this page -->
@yield('extra-js')
</body>
</html>