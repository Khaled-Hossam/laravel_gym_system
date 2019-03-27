
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Blank Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('extra_styles')

</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          @guest
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
          @else
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
          @endguest
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          @can('crud city_managers')
          <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
              <p>
                City Managers
              </p>
            </a>
          </li>
          @endcan

          @can('crud gym_managers')
          <li class="nav-item has-treeview">
            <a href="{{route('gym-managers.index')}}" class="nav-link">
              <p>
              Gym Managers
              </p>
            </a>
          </li>
          @endcan

          @can('crud cities')
          <li class="nav-item has-treeview">
            <a href="{{route('cities.index')}}" class="nav-link">
              <p>
              Cities
              </p>
            </a>
          </li>
          @endcan

          @can('crud packages')
          <li class="nav-item has-treeview">
            <a href="{{route('packages.index')}}" class="nav-link">
              <p>
              Training Packages
              </p>
            </a>
          </li>
          @endcan

          @can('crud coaches')
          <li class="nav-item has-treeview">
            <a href="{{route('coaches.index')}}" class="nav-link">
              <p>
              Coaches
              </p>
            </a>
          </li>
          @endcan

          @can('crud gyms')
          <li class="nav-item has-treeview">
            <a href="{{route('gyms.index')}}" class="nav-link">
              <p>
              Gyms
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
              Members
              </p>
            </a>
          </li>

          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
              Attendance
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('payments.index')}}" class="nav-link">
              <p>
              Buy Package For User
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
              Revenue​ 
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
  
      @yield('content')
       
    </section>
  </div>

</div>
<!-- jQuery -->
href="{{ asset('') }}
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
@yield('extra_scripts')
</body>
</html>
