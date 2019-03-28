<!DOCTYPE html>
<html>
@include('layouts.partials.head')

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  @include('layouts.partials.navbar')

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
            <a href="{{route('attendance.index')}}" class="nav-link">
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
  @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
  
      @yield('content')

    </section>
  </div>

</div>
@include('layouts.partials.foot')
</body>
</html>
