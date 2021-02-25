<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/dist/img/bakteri.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Tracking Covid</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/home.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Anya</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-radiation"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Global
                <i class="fa fa-shield"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('negara.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Negara</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Kasus</p>
                </a>
              </li>
              </ul>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-globe"></i>
              <p>
                Lokal
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('provinsi.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Provinsi</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('kota.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Kota</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('kecamatan.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Kecamatan</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('kelurahan.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Kelurahan</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('rw.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Rw</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="{{ route('tracking.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-globe"></i>
                  <p>Tracking</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="nav-icon far fa-circle text-danger"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                     </form>
                              </li>
                         </li>
                   </ul>
              </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>