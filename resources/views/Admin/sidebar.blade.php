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
                    <img src="/template/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">

                    <a href="#" class="d-block">{{ Auth::user()->hoTen }}</a>
                    {{-- <a href="/logout" class="btn btn-navbar nav-link mb-3">
                        <p>Đăng xuất</p>
                    </a> --}}
                </div>
                <div class="row">
                    <a href="/logout" class="ml-3">
                        <button  type="button" class="btn btn-outline-danger">Đăng xuất</button>
                    </a>
                </div>
        </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3">
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
                <li class="nav-item quanlydanhmuc">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        {{-- <i class="nav-icon bi bi-card-list"></i> --}}
                        <p>
                            Quản lý danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/admin/menu/listDanhMuc" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục hàng cứu trợ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/loaiHoGD/listLoaiHoGD" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loại Hộ gia đình</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/dotlulut/listDotLuLut" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Đợt lũ lụt</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/mucDoThietHai/listMucDoThietHai" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mức độ thiệt hại</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/hoGiaDinh/listHoGiaDinh" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hộ gia đình</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item quanlykho">
                    <a href="#" class="nav-link">
                        {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
                        <i class="nav-icon fa fa-archive" aria-hidden="true"></i>
                        <p>
                            Quản lý kho
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/admin/hanghoa/listDanhMuc" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hàng hóa hỗ trợ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/danhsachunghotien " class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản lý tiền ủng hộ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item pheduyet">
                    <a href="#" class="nav-link">
                        {{-- <i class="nav-icon fas fa-chart-pie"></i> --}}
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Phê duyệt
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/danhsachungho" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DS Ủng hộ hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/danhsachtokhai" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DS tờ khai thiệt hại</p>
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
                            <a href="/admin/PhanBo/" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dự kiến phân bổ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/PhanBo/thongKe" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thống kê dự kiến</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/danhsachphanbo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách phân bổ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item khac">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hashtag"></i>
                        <p>
                            Khác
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/admin/phanQuyen/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phân quyền</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/taoBaiDang/" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tạo bài đăng</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
