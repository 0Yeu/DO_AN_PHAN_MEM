@extends('Admin.main')
@section('content')
    <div class="form-group">
        <label for="idDanhMuc">Đợt lũ lụt</label>
        <select class="form-control" id="selectIDDM" name="idLoaiHoGD" onchange="filterData()">
            @foreach ($dlls as $id)
                <option value="{{ $id->idDotLuLut }}">{{$id->tenDotLuLut}}</option>
            @endforeach
        </select>
    </div>
    <div id="table-data">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hộ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mức độ thiệt hại</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái phân bổ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($hoGiaDinhChuaPhanBo as $item)
                <tr>
                    <td>{{ $item->idHoGiaDinh }}</td>
                    <td>{{ $item->tenMucDo}}</td>
                    <td>Chưa phân bổ</td>
                    <td>

                    </td>
                </tr>
            @endforeach
            @foreach($hoGiaDinhDaPhanBo as $item)
                <tr>
                <tr>
                    <td>{{ $item->idHoGiaDinh }}</td>
                    <td>{{ $item->idMucDoThietHai}}</td>
                    <td>Đã phân bổ</td>
                    <td>
                    </td>
                </tr>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function filterData() {
        var idDanhMuc = document.getElementById("selectIDDM").value;
        var idXa = document.getElementById("selectedIDXa").value;
        var url = "/admin/hoGiaDinh/filterHGD?idLoaiHGD=" + idDanhMuc+"&idXa="+idXa;
        console.log(url);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "html",
            success: function(data) {
                $("#table-data").html(data);
                console.log(data);
            },
            error: function() {
                alert("Lỗi khi tải dữ liệu.");
            }
        });
    }
</script>
