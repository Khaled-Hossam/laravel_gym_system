<!DOCTYPE html>
<html>
@include('layouts.partials.head')

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  @include('layouts.partials.navbar')

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
