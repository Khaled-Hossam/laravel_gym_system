<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="#" class="brand-link">
    <img src="../../dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Gym Admin Panel</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ Auth::user()->avatar ? Storage::disk('public')->url(Auth::user()->avatar) :
            Storage::disk('public')->url('uploads/index.jpeg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <a class="ml-3">
        {{ Auth::user()->name }}
        </a>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        @can('crud city_managers')
        <li class="nav-item has-treeview">
        <a href="{{route('city-managers.index')}}" class="nav-link">
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

        <li class="nav-item has-treeview">
        <a href="{{route('members.index')}}" class="nav-link">
            <p>
            Members
            </p>
        </a>
        </li>

        @can('crud cities')
        <li class="nav-item has-treeview">
        <a href="{{route('cities.index')}}" class="nav-link">
            <p>
            Cities
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

        @can('crud sessions')
        <li class="nav-item has-treeview">
        <a href="{{route('sessions.index')}}" class="nav-link">
            <p>
            Sessions
            </p>
        </a>
        </li>
        @endcan

        
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