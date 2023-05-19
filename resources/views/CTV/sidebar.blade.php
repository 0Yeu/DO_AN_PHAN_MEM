<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">UTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->hoTen }}</a>
            </div>
            <div class="row">
                <a href="/logout" class="ml-3">
                    <button type="button" class="btn btn-outline-danger">Đăng xuất</button>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                {{--          <li class="nav-item"> --}}
                {{--            <a href="#" class="nav-link"> --}}
                {{--              <i class="nav-icon fas fa-tachometer-alt"></i> --}}
                {{--              <p> --}}
                {{--                Quản lý --}}
                {{--                <i class="right fas fa-angle-left"></i> --}}
                {{--              </p> --}}
                {{--            </a> --}}
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item pheduyet">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Phê duyệt
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="/danhsachungho" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách ủng hộ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/danhsachtokhai" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Danh sách tờ khai</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                {{-- <li class="nav-item">
                    <a href="/logout" class="btn btn-navbar nav-link mb-3" style="position: fixed;bottom: 0">
                        <p>Đăng xuất</p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/danhsachungho" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách ủng hộ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/danhsachtokhai" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách tờ khai</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item phanbo">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Phân bổ
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/danhsachphanbo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách phân bổ</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
