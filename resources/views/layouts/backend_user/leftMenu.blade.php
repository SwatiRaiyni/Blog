
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->



    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{__('msg.Admin Dashboard')}}</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/storage/images/userprofile/{{Auth::guard('admin')->user()->Profile}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">

            <a href="/{{app()->getLocale()}}/admin_dashboard1" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{__('msg.Dashboard')}}
                </p>
              </a>

          </li>
          <li class="nav-item">
            <a href="/{{app()->getLocale()}}/user_blog" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                {{__('msg.Blog Management')}}
              </p>
            </a>
          </li>

{{--
              <li class="nav-item">
                <a href="{{ route('editprofile') }}" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                  <p>My Calender</p>
                </a>
              </li> --}}



          {{-- <li class="nav-item">
            <a href="{{ route('usermangementajaxview') }}" class="nav-link">

              <i class="nav-icon fas fa-copy"></i>
              <p>
                User Management
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <a href="/{{app()->getLocale()}}/usermangementajaxviewserverside"  class="nav-link">

              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('msg.User Management')}}
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                {{__('msg.My Settings')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


              <li class="nav-item">
                <a href="/{{app()->getLocale()}}/passwordchange" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('msg.Change Password')}}</p>
                </a>
              </li>

            </ul>


          <li class="nav-item">
            <a href="/{{app()->getLocale()}}/cmsmanagement" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                    {{__('msg.CMS Management')}}
                </p>
            </a>
          </li>

            {{-- <li class="nav-item">
              <a
                href="{{ route('laratrust.roles-assignment.index') }}"
                class="nav-link"
              >
              <i class="nav-icon fas fa-copy"></i>
                <p>Roles Assignment</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{route('laratrust.roles.index')}}" class="nav-link">

                <i class="nav-icon fas fa-copy"></i>
                <p>
                    {{__('msg.Role Management')}}
                </p>
              </a>

            </li>

            <li class="nav-item">
              <a href="{{ route('laratrust.permissions.index') }}" class="nav-link">

                <i class="nav-icon fas fa-copy"></i>
                <p>
                    {{__('msg.Permission Management')}}
                </p>
              </a>
            </li>



          <li class="nav-item">

            <form method="POST" action="/admin/logout">
              @csrf
              <a href="/admin/logout" class="nav-link"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                  <i class="nav-icon far fa-circle text-danger"></i>
                <p>{{__('msg.Log Out')}} </p>
              </a>
          </form>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
