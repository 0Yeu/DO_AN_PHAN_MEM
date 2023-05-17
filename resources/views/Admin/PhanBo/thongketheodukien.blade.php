@extends('admin.main')
@section('head')
    @parent
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        .select2-selection__rendered{
            padding: 0;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: unset;
            height: unset;
            margin-top: unset;
        }
        hr:not([size]) {
            height: 5px;
            background-color: BLACK;
            opacity: 1;
        }

        hr {
            height: 5px; !important;/* Đặt chiều cao của hr */
            background-color: black; /* Đặt màu nền của hr */
            border: none; /* Loại bỏ viền của hr */
            margin: 20px 0; /* Đặt khoảng cách trên và dưới của hr */
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
@endsection
@section('content')
    <div class="container">
            <div class="form-group">
                <label for="name">Đợt lũ lụt:</label>
                <select class="hanghoa-select form-control" id="selectedIDDLL" data-search="true" name="idDotlulut" onchange="filterData()">
                    @foreach($DotLuLut as $dll)
                        <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>
                    @endforeach
                </select>
            </div>
            <div id="table-data">
                <table class="table table table-striped" >
                    <thead class="card-header" style="background: #00bb00; margin-top: 20px">
                    <tr class="">
                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hàng</th>
                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên hàng</th>
                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tổng số lượng phân bổ theo dự tính</th>
                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng còn trong kho</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($menus->count()>0)
                        @foreach($menus as $item)
                            <tr {{$item->soLuong>$item->soLuongCon?'style=color:RED;':''}}>
                                <td>{{ $item->idHangCuuTro }}</td>
                                <td>{{ $item->tenHangCuuTro}}</td>
                                <td>{{ $item->soLuong }}</td>
                                <td>{{ $item->soLuongCon }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
    </div>
@endsection
@section('footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        function filterData() {
            var idDanhMuc = document.getElementById("selectedIDDLL").value;
            var url = "/admin/PhanBo/filterMDTH3?idDLL=" + idDanhMuc;
            console.log(url);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $("#table-data").html(data);
                    loadScript();
                    console.log(data);
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
    </script>
@endsection
