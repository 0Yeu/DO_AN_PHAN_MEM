<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            {{--            <a class="navbar-brand" href="#">Cứu Trợ Lũ Lụt</a>--}}
            {{--             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--            <span class="navbar-toggler-icon"></span>--}}
            {{--          </button>--}}
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
                <a class="nav-link" href="/login"><button class="btn btn-primary" type="submit">Đăngnhập</button></a>
            </div>
        </div>
    </nav>
</header>
<div class="container" style="margin-top: 100px">
    <h1>Chi tiết ủng hộ</h1>
    @if($chiTietList[0]->idQuyen==1)
        <h4>Khách vãng lai</h4>
        <h4>{{$chiTietList[0]->thoiGianUngHo}}</h4>
    @else
        <h4>{{$chiTietList[0]->hoTen}}</h4>
        <h4>{{$chiTietList[0]->thoiGianUngHo}}</h4>
    @endif
    <form method="POST" action="">
        @csrf
        <table class="table table-striped table-valign-middle">
            <thead>
            <tr>
                <th>Tên hàng cứu trợ</th>
                <th>Số lượng</th>
                <th>Số lượng thực nhận</th>
                <th>Trạng thái phê duyệt</th>
                @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen<2)
                    <th>Phê duyệt</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($chiTietList as $chiTiet)
                <tr>
                    <td>{{$chiTiet->tenHangCuuTro}} - {{$chiTiet->donViTinh}}</td>
                    <td>{{$chiTiet->soLuong}}</td>
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen<2)
                        <td><input type="number" name="soLuongThucNhan[]" value="0"></td>th>Số lượng thực nhận</th>
                    @else
                        <td>{{$chiTiet->soLuongThucNhan}}</td>
                    @endif
                    @if($chiTiet->trangThaiPheDuyet==1)
                        <td>Chưa duyệt</td>
                    @else
                        <td>Đã duyệt</td>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen<2)
                        <td> <button class="btn btn-success btn-phe-duyet" data-id="{{$chiTiet->idHangCuuTro}}">Phê duyệt</button></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen<2)
            <td> <button class="btn btn-success btn-phe-duyet" type="submit" data-id="{{$chiTiet->idHangCuuTro}}">Phê duyệt tất cả</button></td>
        @endif
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        // Xử lý sự kiện khi nhấn nút Phê duyệt
        $('.btn-phe-duyet').click(function(){
            var id = $(this).data('id');
            $.ajax({
                url: '/phe-duyet/' + id,
                type: 'PUT',
                data: {_token: '{{csrf_token()}}'},
                success: function(response){
                    // Thông báo phê duyệt thành công
                    alert('Phê duyệt thành công!');
                    // Cập nhật lại trạng thái phê duyệt của hàng cứu trợ trong bảng
                    $(this).parent().prev().text('Đã phê duyệt');
                },
                error: function(xhr, status, error){
                    // Hiển thị lỗi nếu có
                    alert(xhr.responseText);
                }
            });
        });
    });
</script>
