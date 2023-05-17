@extends('HoGiaDinh.main')
@section('head')
    @parent
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
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
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice" id="coRadioButton" value="co" {{$result->count() > 0 && $result[0]->thietHaiVeNguoi != 0 ? 'checked' : ''}} >
                                <label class="form-check-label" for="coRadioButton">
                                    Có
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="choice" id="khongRadioButton" {{$result->count() == 0||($result->count() > 0 && $result[0]->thietHaiVeNguoi == 0) ? 'checked' : ''}} value="khong">
                                <label class="form-check-label" for="khongRadioButton">
                                    Không
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="inputContainer" style="display:{{$result->count() > 0 && $result[0]->thietHaiVeNguoi != 0 ? 'block' : 'none'}} ;" >
                                <label for="textInput">Số người:</label>
                                <input class="form-control" type="number" name="thietHaiVeNguoi" id="textInput" value="{{$result->count()>0?$result[0]->thietHaiVeNguoi:''}}"></input>
                            </div>
                        </div>
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
                    @if($DotLuLut->count() ==0)
                        <p style="color: red">*Không có đợt lũ nào cho phép khai báo thiệt hại</p>
                    @else
                        <button type="submit" class="btn btn-primary">Gửi tờ khai</button>
                    @endif
                    @csrf
                </form>
            </div>

            <div class="col-lg-2">
                <div id="motaSelect">
                    <ul class="list-group">
                        @foreach($MucDos as $dll)
                            <li class="">
                                {{$dll->tenMucDo}}
                                <span class="badge bg-danger badge-lg" style="font-size: 100%!important">{{$dll->moTa}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
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
                    // console.log(data);
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
            url = "/HoGiaDinh/filterMDTH2?idDLL=" + idDanhMuc;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $("#motaSelect").html(data);
                    loadScript();
                    // console.log(data);
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
            // Lấy ra các đối tượng radioButton và input
            var coRadioButton = document.getElementById("coRadioButton");
            var khongRadioButton = document.getElementById("khongRadioButton");
            var inputContainer = document.getElementById("inputContainer");

// Gắn sự kiện change vào radioButton
            coRadioButton.addEventListener("change", function() {
                if (coRadioButton.checked) {
                    inputContainer.style.display = "block"; // Hiển thị thẻ input
                } else {
                    inputContainer.style.display = "none"; // Ẩn thẻ input
                }
            });
            khongRadioButton.addEventListener("change", function() {
                if (khongRadioButton.checked) {
                    inputContainer.style.display = "none"; // Hiển thị thẻ input
                } else {
                    inputContainer.style.display = "block"; // Ẩn thẻ input
                }
            });
        }
        $(document).ready(function() {
            loadScript();
        });
    </script>
@endsection
