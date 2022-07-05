<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <ul style="list-style: none;">

        <li><b> {{__('msg.Welcome')}}</b> {{Auth::guard('admin')->user()->name}} </li>


      </ul>


    </ul>
  </nav>
  <!-- /.navbar -->
