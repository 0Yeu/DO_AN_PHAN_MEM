@extends('Admin.main')
@section('style')
    <style>
        .alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
        }
        #successDialog .modal-content {
            border: none;
            background-color: transparent;
            box-shadow: none;
        }

        #successDialog .modal-body {
            padding: 0;
        }

        #successDialog .alert {
            border-radius: 0;
            margin: 0;
        }
        #errorDialog .modal-content {
            border: none;
            background-color: transparent;
            box-shadow: none;
        }

        #errorDialog .modal-body {
            padding: 0;
        }

        #errorDialog .alert {
            border-radius: 0;
            margin: 0;
        }


    </style>
@endsection
@section('content')
    <!-- Trong phần HTML -->
    <div class="modal fade" id="successDialog" tabindex="-1" role="dialog" aria-labelledby="successDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-success" role="alert">
                        Cập nhật thành công.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="errorDialog" tabindex="-1" role="dialog" aria-labelledby="errorDialogLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        Có lỗi xảy ra. Không thể cập nhật dữ liệu.
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="confirmPasswordModal" tabindex="-1" role="dialog" aria-labelledby="confirmPasswordModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmPasswordModalLabel">Xác nhận mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="password" class="form-control" id="passwordInput" placeholder="Nhập mật khẩu">
                    <p id="successDialog" style="display: none;color: red">Sai mật khẩu</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" id="confirmBtn" class="btn btn-primary">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchBox" placeholder="Tìm kiếm...">
            <div class="input-group-append">
                <button class="btn btn-primary" id="searchButton" type="button">Tìm</button>
            </div>
    </div>


    <div id="searchResults">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Họ tên</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Giới tính</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Email</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Ngày sinh</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Địa chỉ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">SĐT</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Quyền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->hoTen }}</td>
                    <td>{{ $item->gioiTinh}}</td>
                    <td>{!! $item->Email !!}</td>
                    <td>{!! $item->ngaySinh !!}</td>
                    <td>{!! $item->diaChi !!}</td>
                    <td>{!! $item->soDT !!}</td>
                    <td>
                        <select class="form-control" id="selectIDDM" name="idQuyen" onchange="update(this)">
                            @foreach ($dlls as $id)
                                @if($id->idQuyen==$item->idQuyen)
                                    <option value="{{ $id->idQuyen }}" data-id="{{ $item->idNguoiDung }}" selected>{{$id->tenQuyen}}</option>
                                @else
                                    <option value="{{ $id->idQuyen }}" data-id="{{ $item->idNguoiDung }}">{{$id->tenQuyen}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-tools float-right">
        <ul class="pagination pagination-sm">
            @if ($menus->onFirstPage())
                <li class="disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item" ><a class="page-link" href="{{ $menus->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif


            @if ($menus->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $menus->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var cancelButtonClicked = false;

            $('#confirmPasswordModal').on('hide.bs.modal', function (e) {
                if (!cancelButtonClicked) {
                    // Xử lý sự kiện khi nút "Hủy" không được ấn
                    console.log('Nút "Hủy" không được ấn');
                    $('#successDialog').modal('show');

                    // Hiển thị alertContainer với hiệu ứng fade in
                    // Thực hiện các tác vụ khác tại đây
                }
                // Đặt lại giá trị của biến cancelButtonClicked
                cancelButtonClicked = false;
            });

            // Xử lý sự kiện khi nút "Hủy" được ấn
            $('#confirmPasswordModal').on('click', '.btn-secondary', function() {
                $('#errorDialog').modal('show');
                cancelButtonClicked = true;
            });

            // Xử lý sự kiện khi nút "X" (nút đóng) được nhấn
        });


        function update(selectElement) {
            var selectedValue = $(selectElement).val(); // Lấy giá trị được chọn từ select
            var selectedId = $(selectElement).find('option:selected').data('id');
            if (selectedValue == 1) {
                $('#confirmPasswordModal').modal('show').on('shown.bs.modal', function() {
                    $('#confirmPasswordModal').off('shown.bs.modal'); // Loại bỏ sự kiện này sau khi đã hiển thị dialog
                    $('#confirmPasswordModal').on('click', '#confirmBtn', function() {
                        var password = $('#passwordInput').val();
                        // Gửi yêu cầu AJAX để xác nhận mật khẩu
                        $.ajax({
                            url: '/admin/phanQuyen/validate-password',
                            type: 'POST',
                            data: { password: password },
                            success: function(response) {
                                // Xử lý phản hồi từ máy chủ (nếu cần)
                                $.ajax({
                                    url: "/admin/phanQuyen/update-IdQuyen",
                                    method: "POST",
                                    data: { idQuyen: selectedValue ,idNguoiDung: selectedId},
                                    success: function(response) {
                                        // Xử lý phản hồi từ máy chủ nếu cần thiết
                                        $('#successDialog').modal('show');

                                        console.error(response);
                                    },
                                    error: function(xhr, status, error) {
                                        $('#errorDialog').modal('show');
                                        // Xử lý lỗi nếu có
                                        console.error(error);
                                    }
                                });
                                // Đóng dialog
                                $('#confirmPasswordModal').modal('hide');
                            },
                            error: function(xhr, status, error) {
                                // Xử lý lỗi (nếu có)
                                // console.error(error);
                                $(document).ready(function() {
                                    $("#successDialog").show();
                                });
                                // $('#confirmPasswordModal').modal('hide');
                            }
                        });
                    });
                });
            } else {
                // Gửi yêu cầu cập nhật idQuyen thông qua AJAX (không yêu cầu xác nhận)
                $.ajax({
                    url: "/admin/phanQuyen/update-IdQuyen",
                    method: "POST",
                    data: { idQuyen: selectedValue ,idNguoiDung: selectedId},
                    success: function(response) {
                        // Xử lý phản hồi từ máy chủ nếu cần thiết
                        $('#successDialog').modal('show');
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi nếu có
                        $('#errorDialog').modal('show');

                        console.error(error);
                    }
                });
            }
        }
        // Gắn sự kiện click cho nút Tìm
        $('#searchButton').click(function() {
            performSearch();
        });

        // Gắn sự kiện keyup cho ô search để tìm kiếm khi nhấn Enter
        $('#searchBox').keyup(function(event) {
            // if (event.keyCode === 13) {
                performSearch();
            // }
        });

        // Hàm thực hiện tìm kiếm
        function performSearch() {
            var keyword = $('#searchBox').val(); // Lấy từ khóa tìm kiếm từ ô search

            // Gửi yêu cầu AJAX để tìm kiếm
            $.ajax({
                url: '/admin/phanQuyen/search',
                type: 'GET',
                data: { keyword: keyword },
                success: function(response) {
                    // Xử lý phản hồi từ server
                    console.log(response);
                    $('#searchResults').html(response); // Hiển thị kết quả tìm kiếm trong div có id "searchResults"
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error(error);
                }
            });
        }
    </script>
@endsection
