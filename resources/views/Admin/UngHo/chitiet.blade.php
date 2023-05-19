<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                {{--            <a class="navbar-brand" href="#">Cứu Trợ Lũ Lụt</a> --}}
                {{--             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> --}}
                {{--            <span class="navbar-toggler-icon"></span> --}}
                {{--          </button> --}}
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="navbar-brand" aria-current="page" href="/">Cứu Trợ Lũ Lụt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/DangKyUngHo">Đăng ký ủng hộ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/danhsachungho">Danh sách ủng hộ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    {{-- <a class="nav-link" href="/login"><button class="btn btn-primary" type="submit">Đăng nhập</button></a> --}}
                    @if (\Illuminate\Support\Facades\Auth::check())
                        @if (\Illuminate\Support\Facades\Auth::user()->idQuyen == 4)
                            <a class="navbar-brand" aria-current="page"
                                style="margin-right: 0px!important;margin-left: 16px"
                                href="/">{{ \Illuminate\Support\Facades\Auth::user()->hoTen }}</a>
                            <a class="nav-link" href="/logout"><button class="btn btn-light"
                                    style="margin-left: 0px!important;" type="submit">Đăng xuất</button></a>
                        @else
                            <a class="nav-link" href="/logout"><button class="btn btn-light" type="submit">Đăng
                                    xuất</button></a>
                        @endif
                    @else
                        <a class="nav-link" href="/login"><button class="btn btn-light" type="submit">Đăng
                                nhập</button></a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    <div class="container" style="margin-top: 100px">
        <h1>Chi tiết ủng hộ</h1>
        @if ($chiTietList[0]->idQuyen == 1)
            <h4>Khách vãng lai</h4>
            <h4>{{ $chiTietList[0]->thoiGianUngHo }}</h4>
        @else
            <h4>{{ $chiTietList[0]->hoTen }}</h4>
            <h4>{{ $chiTietList[0]->thoiGianUngHo }}</h4>
        @endif
        <form method="POST" action="/phe-duyet-all">
            @csrf
            <input type="hidden" name="idUngHo" value="{{ $idUngHo }}">
            <input type="hidden" name="idUngHo" value="{{ $chiTietList[0]->idNguoiDung }}">
            <table class="table table-striped table-valign-middle">
                <thead>
                    <tr>
                        <th>Tên hàng cứu trợ</th>
                        <th>Số lượng</th>
                        <th>Số lượng thực nhận</th>
                        <th>Trạng thái phê duyệt</th>
                        @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen < 2)
                            <th>Phê duyệt</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chiTietList as $chiTiet)
                        <tr>
                            <td>{{ $chiTiet->tenHangCuuTro }} - {{ $chiTiet->donViTinh }}
                                <input type="hidden" name="idHangCuuTro[]" value="{{ $chiTiet->idHangCuuTro }}">
                            </td>
                            <td>{{ $chiTiet->soLuong }}</td>
                            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen < 2)
                                @if ($chiTiet->trangThaiPheDuyet != 1)
                                    <td><input type="number" name="soLuongThucNhan[]"
                                            value="{{ $chiTiet->soLuongThucNhan }}" min="0"></td>
                                @else
                                    <td><input type="number" name="soLuongThucNhan[]" value="{{ $chiTiet->soLuong }}"
                                            min="0"></td>
                                @endif
                            @else
                                <td>{{ $chiTiet->soLuongThucNhan }}</td>
                            @endif
                            @if ($chiTiet->trangThaiPheDuyet == 1)
                                <td class="trang-thai-phe-duyet" style="color: red">Chưa duyệt</td>
                            @else
                                <td class="trang-thai-phe-duyet">Đã duyệt</td>
                            @endif
                            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen < 2)
                                <td>
                                    <p id="btnPheDuyet" class="btn btn-success btn-phe-duyet"
                                        data-id="{{ $chiTiet->idHangCuuTro }}" onclick="pheDuyet(this)">Phê duyệt</p>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen < 2)
                <td> <button type="button" class="btn btn-success btn-phe-duyet" id="btn_pheDuyetAll" type="submit"
                        data-id="{{ $chiTiet->idHangCuuTro }}">Phê duyệt tất cả</button></td>
            @endif
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Lấy giá trị CSRF token từ thẻ meta
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Thiết lập CSRF token cho mọi yêu cầu Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
    <script>
        function pheDuyet(selected) {
            var idHangCuuTro = $(selected).data('id');
            var soLuongThucNhan = $(selected).closest('tr').find('input[name="soLuongThucNhan[]"]').val();
            console.log(idHangCuuTro, soLuongThucNhan);

            // Gửi Ajax request với CSRF token
            $.ajax({
                url: '/phe-duyet',
                method: 'POST',
                data: {
                    _token: csrfToken, // Thêm CSRF token vào dữ liệu gửi đi
                    idHangCuuTro: idHangCuuTro,
                    soLuongThucNhan: soLuongThucNhan,
                    idUngHo: {{ $idUngHo }}
                },
                success: function(response) {
                    // Xử lý thành công
                    console.log('Phê duyệt thành công!');
                    var tr = $(selected).closest('tr');
                    tr.find('.trang-thai-phe-duyet').text('Đã duyệt').css('color', 'black');
                    tr.find('input[name="soLuongThucNhan[]"]').text(soLuongThucNhan);

                    // Cập nhật trạng thái và hiển thị thông tin đã cập nhật nếu cần
                    // ...
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu có)

                }
            });
        }
    </script>
    <script>
        // Xử lý khi ấn phê duyệt tất cả
        $(document).ready(function() {
            $('#btn_pheDuyetAll').click(function() {
                var soLuongThucNhanList = [];
                var idHangCuuTroList = [];

                // Lặp qua tất cả các input số lượng thực nhận
                $('input[name="soLuongThucNhan[]"]').each(function() {
                    var soLuongThucNhan = $(this).val();
                    console.log(soLuongThucNhan);
                    soLuongThucNhanList.push(soLuongThucNhan);
                });
                $('input[name="idHangCuuTro[]"]').each(function() {
                    var idHangCuuTro = $(this).val();
                    idHangCuuTroList.push(idHangCuuTro);
                });
                console.log(soLuongThucNhanList, idHangCuuTroList);
                // Gửi Ajax request với CSRF token
                $.ajax({
                    url: '/phe-duyet-all',
                    method: 'POST',
                    data: {
                        _token: csrfToken, // Thêm CSRF token vào dữ liệu gửi đi
                        idUngHo: {{ $idUngHo }},
                        soLuongThucNhanList: soLuongThucNhanList,
                        idHangCuuTroList: idHangCuuTroList
                    },
                    success: function(response) {
                        // Xử lý thành công
                        console.log('Phê duyệt tất cả thành công!');
                        $('.trang-thai-phe-duyet').text('Đã duyệt').css('color', 'black');
                        $('input[name="soLuongThucNhan[]"]').each(function(index) {
                            $(this).val(soLuongThucNhanList[index]);
                        });

                        // Cập nhật trạng thái và hiển thị thông tin đã cập nhật nếu cần
                        // ...
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.log(error);

                    }
                });
            });
        });
    </script>
