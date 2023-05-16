<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .card-text+p{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis;height: 70px!important;max-height: 70px;
        }
        .card-body+h3{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;height: 70px!important; ;max-height: 70px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tải Select2 từ CDN -->
    <title>Khai báo thiệt hại</title>
    <style type="text/css">
        .select2-selection__rendered{
            padding: 0;
        }
        select{
            padding: 0!important;
        }

        #formgui {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    {{--    @include('Admin.head');--}}
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
                <a class="nav-link" href="/login"><button class="btn btn-primary" type="submit">Đăng nhập</button></a>
            </div>
        </div>
    </nav>
</header>
<div class="container" style="margin-top: 100px">
    <h1 style="text-align: center">Khai báo thiệt hại</h1>
    <form action="/HoGiaDinh/GuiToKhai" method="POST" id="formgui">
        <div class="form-group">
            <label>Mã hộ:</label>
            <input type="text" name="idHoGiaDinh" readonly value="{{\Illuminate\Support\Facades\Auth::user()->hoTen}}"></input>
        </div>
        <div class="form-group">
            <label for="name">Đợt lũ lụt:</label>
            <select class="hanghoa-select form-control" id="selectedIDMDTH" data-search="true" name="idDotLuLut" onchange="filterData()">
                @if($DotLuLut->count() ==0)
                    <option value="-1">Không có đợt lũ nào cho phép khai báo thiệt hại</option>
                @else
                    @foreach($DotLuLut as $dll)
                        <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div id="data-select">
            <div class="form-group">
                <label for="description">Mô tả thiệt hại:</label>
                <textarea class="form-control" id="description" name="thietHaiVeTaiSan" rows="4" required>{{$result->count()>0?$result[0]->thietHaiVeTaiSan:''}}</textarea>
            </div>
            <div class="form-group">
                <label for="name">Ước tính tổng thiệt hại:</label>
                <input type="number" class="form-control" id="money" name="UocTinhTongThietHai" value="{{$result->count()>0?$result[0]->uocTinhTongThietHai:'0'}}" min="0" step="1000" required>
            </div>
            <div class="form-group">
                <label for="name">Mức độ thiệt hại dự kiến:</label>
                <select class="hanghoa-select form-control" data-search="true" name="idMucDoThietHai">
                    @foreach($MucDos as $dll)
                        <option  value="{{$dll->idMucDoThietHai}}" {{$result->count()>0?$result[0]->idMucDoThietHai==$dll->idMucDoThietHai?'selected':'':''}}>{{$dll->tenMucDo}}</option>
                    @endforeach
                </select>
            </div>
            @if($result->count()>0)
                <div class="form-group">
                    <label for="name">Trạng thái phê duyệt:</label>
                    <input type="text" value="{{$result[0]->trangThaiPheDuyet}}" readonly></input>
                </div>
            @endif
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="date">Ngày khai báo:</label>--}}
{{--            <input type="date" class="form-control" id="date" name="thoigian" value="{{ date('Y-m-d') }}" required>--}}
{{--        </div>--}}
        @if($DotLuLut->count() ==0)
            <p style="color: red">*Không có đợt lũ nào cho phép khai báo thiệt hại</p>
        @else
            <button type="submit" class="btn btn-primary">Gửi tờ khai</button>
        @endif
        @csrf
    </form>

</div>
@section('footer')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>
    function filterData() {
        var idDanhMuc = document.getElementById("selectedIDMDTH").value;
        var url = "/HoGiaDinh/filterMDTH1?idDLL=" + idDanhMuc;
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html",
            success: function(data) {
                $("#data-select").html(data);
                loadScript();
                console.log(data);
            },
            error: function() {
                alert("Lỗi khi tải dữ liệu.");
            }
        });
    }
</script>
<script>
    function loadScript() {
        $('.hanghoa-select').select2();
    }
    $(document).ready(function() {
        loadScript();
    });
</script>
</body>
</html>
