<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Rajah Rayvles Pangkey</a>
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/paket" class="nav-link">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    <p>
                        Laundry Package
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/outlet/{{ $outlet->id }}/member" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Member
                    </p>
                </a>
            </li>
            <li class="nav-header">Laundry</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tshirt"></i>
                    <p>
                        Data Laundry
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Processed</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Finish</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('adminlte') }}/index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Cancel</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">TRANSACTION</li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                        New Transaction
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Report
                    </p>
                </a>
            </li>
            <li class="nav-header">ADMIN</li>
            <li class="nav-item">
                <a href="/admin" class="nav-link">
                    <i class="nav-icon fas fa-arrow-left"></i>
                    <p>
                        Admin Page
                    </p>
                </a>
            </li>
        </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>