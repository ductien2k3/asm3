<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="AdminLTE Logo" class="brand-image rounded-circle " style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle " alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->full_name }}</a>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.category.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Danh mục
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.courses.index')}}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Khoá học
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.lessons.index')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Bài Học
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.class.index')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Lớp Học
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.orders.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Đơn Hàng
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.promotion.index')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Mã Giảm Giá
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Đánh Giá
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.user.index')}}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Thống kê
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>