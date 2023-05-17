<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Danh sách ủng hộ</title>
    <style>
        .card-text+p{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis;height: 70px!important;max-height: 70px;
        }
        .card-body+h3{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;height: 70px!important; ;max-height: 70px;
        }
    </style>
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
    <h1>Danh sách ủng hộ</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên người ủng hộ</th>
            <th>Thời gian ủng hộ</th>
            <th>Trạng thái phê duyệt</th>
            <th>Chi tiết</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ungHoList as $ungHo)
            <tr>
                <td>{{$ungHo->idUngHo}}</td>
                @if ($ungHo->idNguoiDung==1)
                    <td>Khách vãng lai</td>
                @else
                    <td>{{$ungHo->tenNguoiDung}}</td>
                @endif
                <td>{{$ungHo->thoiGianUngHo}}</td>
                <td>{{$ungHo->trangThaiPheDuyet}}</td>
                <td>
                    <a class="btn btn-primary btn-chi-tiet" href="/chitietungho?id={{$ungHo->idUngHo}}">Chi tiết</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $('.btn-chi-tiet').click(function() {
            var idUngHo = $(this).data('id');
            window.location.href = '/ung-ho/' + idUngHo;
        });
    });
</script>
</body>
</html>
