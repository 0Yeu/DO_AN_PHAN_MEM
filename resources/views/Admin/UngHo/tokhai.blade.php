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
    <title>Đăng ký ủng hộ</title>
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
    <h1>Đăng ký ủng hộ</h1>
    <form action="/GuiUngHo" method="POST" id="formgui">
        <div class="form-group">
            <label>Tên người ủng hộ:</label>
            @if (\Illuminate\Support\Facades\Auth::check())
                <p>{{\Illuminate\Support\Facades\Auth::user()->hoTen}}</p>
            @else
                <p style="color: red">*Hiện bạn chưa đăng nhập. Thông tin sẽ được lưu thành khách vãng lai </p>
            @endif
        </div>
        <div class="form-group">
            <label for="name">Đợt lũ lụt:</label>
            <select class="hanghoa-select form-control" data-search="true" name="dotlulut">
                @foreach($DotLuLut as $dll)
                    <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="value">Hàng hóa ủng hộ:</label>
            <table class="table table-striped table-valign-middle">
                <thead>
                <tr>
                    <th>STT</th>
                    <th style="width: 400px;">Tên hàng hóa</th>
                    <th>Số lượng</th>
                    <th><button type="button" class="btn btn-success btn-sm btn-add">+</button></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <label for="name">Số tiền ủng hộ:</label>
            <input type="number" class="form-control" id="money" name="money" value="0" min="0" step="1000" required>
        </div>
        <div class="form-group">
            <label for="date">Ngày ủng hộ:</label>
            <input type="date" class="form-control" id="date" name="thoigian" value="{{ date('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Gửi tờ khai</button>
        @csrf
    </form>

</div>
@section('footer')
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script>
    const table = document.querySelector('table');
    const btnAdd = document.querySelector('.btn-add');

    btnAdd.addEventListener('click', () => {
        const rowCount = table.rows.length;
        const row = table.tBodies[0].insertRow(-1);
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        cell1.textContent = rowCount;
        cell2.innerHTML = `
              <select class="hanghoa-select form-control" data-search="true" name="hanghoa[]">
                @foreach($HangCT as $hct)
                    <option  value="{{$hct->idHangCuuTro}}">{{$hct->tenHangCuuTro}} - {{$hct->donViTinh}}</option>
                @endforeach
              </select>`;
        cell3.innerHTML = '<input type="number" name="soluong[]" value="1" min="0">';
        cell4.innerHTML = '<button class="btn-remove btn btn-danger btn-sm" type="button">X</button>';
        cell4.querySelector('.btn-remove').addEventListener('click', removeRow);

        // Add event listener for new remove button
        const newBtnRemove = row.querySelector('.btn-remove');
        newBtnRemove.addEventListener('click', removeRow);
        $(document).ready(function() {
            $('.hanghoa-select').select2();
        });
    });

    function removeRow() {
        const row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateRowCount();
    }

    function updateRowCount() {
        const rowCount = table.rows.length;
        for (let i = 1; i < rowCount; i++) {
            table.rows[i].cells[0].textContent = i;
        }
    }
    $(document).ready(function() {
        $('.hanghoa-select').select2();
    });
</script>
</body>
</html>
