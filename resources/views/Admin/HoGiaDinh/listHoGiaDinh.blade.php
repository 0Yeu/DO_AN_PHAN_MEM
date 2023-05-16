@extends('Admin.main')
@section('content')
    <a href="/admin/hoGiaDinh/addHoGiaDinh" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm hộ gia đình</a>
    <div class="form-group">
        <label for="idDanhMuc">Loại hộ gia đình</label>

        <select class="form-control" id="selectIDDM" name="idLoaiHoGD" onchange="filterData()">
            <option value="-1">Tất cả</option>
            @foreach ($dlls as $id)
                <option value="{{ $id->idLoaiHoGD }}">{{$id->LoaiHoGD}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="idDanhMuc">Xã</label>
        <select class="form-control" id="selectedIDXa" name="idXa" onchange="filterData()">
            <option value="-1">Tất cả</option>
            @foreach ($xas as $id)
                <option value="{{ $id->idXa }}">{{$id->tenXa}}</option>
            @endforeach
        </select>
    </div>
    <div id="table-data">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hộ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Loại hộ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng thành viên</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Địa chỉ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->idHoGiaDinh }}</td>
                    <td>{{ $item->LoaiHoGD}}</td>
                    <td>{{ $item->soLuongThanhVien }}</td>
                    <td>{{ $item->diaChi}}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/hoGiaDinh/editHoGiaDinh?idHoGiaDinh={{$item->idHoGiaDinh}}"><span class="material-symbols-outlined">
                            edit
                        </span></a>
                        <a class="btn btn-danger" href="/admin/hoGiaDinh/destroy?idHoGiaDinh={{$item->idHoGiaDinh}}"><span class="material-symbols-outlined">
                        delete
                        </span>
                        </a>

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
