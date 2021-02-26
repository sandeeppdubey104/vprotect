 <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('home') }}">
        <img src="{{ asset('public/user/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="{{ asset('public/user/img/theme/team-1-800x800.jpg') }}">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a> 
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.html">
                <img src="{{ asset('public/user/img/brand/blue.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home.sale_sub') }}">
              <i class="ni ni-planet text-blue"></i> Sales Subscriptions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home.invoices') }}">
              <i class="ni ni-bullet-list-67 text-primary"></i> Invoices
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home.payments') }}">
              <i class="ni ni-bullet-list-67 text-primary"></i> Payments
            </a>
          </li>  
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.unregisterpayments') }}">
              <i class="ni ni-bullet-list-67 text-primary"></i>Unregister Payments
            </a>
          </li>        
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home.passalert') }}">
              <i class="ni ni-key-25 text-info"></i> Change Password
            </a>
          </li>
          <li class="nav-item">
           {{--  <a href="{!! route('organisations.index', ['menu' => 'p11-c3']) !!}"> --}}
            <a class="nav-link" href="{{ route('register.profile', ['id' => Auth::user()->id]) }}">
              <i class="ni ni-circle-08 text-pink"></i> Profile
            </a>
          </li> {{-- --}}
        </ul>
        
      </div>
    </div>
  </nav>