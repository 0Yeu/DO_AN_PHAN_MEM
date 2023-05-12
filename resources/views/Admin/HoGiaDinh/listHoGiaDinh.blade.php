@extends('Admin.main')
@section('content')
    <a href="/admin/hoGiaDinh/addHoGiaDinh" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm hộ gia đình</a>
    <div class="form-group">
        <label for="idDanhMuc">Loại hộ gia đình</label>

        <select class="form-control" id="selectIDDM" name="idLoaiHoGD" onchange="filterData()">
            @foreach ($dlls as $id)
                <option value="{{ $id->idLoaiHoGD }}">{{ $id->idLoaiHoGD }}</option>
            @endforeach
        </select>
    </div>

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
                <td>{{ $item->idLoaiHoGD}}</td>
                <td>{{ $item->soLuongThanhVien }}</td>
                <td>{{ $item->diaChi}}</td>
                <td>
                    <a class="btn btn-warning" href="/admin/hoGiaDinh/editHoGiaDinh?idHoGiaDinh={{$item->idHoGiaDinh}}">Chỉnh sửa</a>
                    <a class="btn btn-danger" href="/admin/hoGiaDinh/destroy?idHoGiaDinh={{$item->idHoGiaDinh}}">Xóa
                        <i class="fas fa-trash"></i>
                    </a>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
        


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
<script>
   function filterData() {
    var idLoaiHoGD = document.getElementById("selectIDDM").value;
    var url = "/admin/hoGiaDinh/filterHoGiaDinh?idLoaiHoGD=" + idLoaiHoGD;
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        success: function(data) {
            $("#table").html(data);
        },
        error: function() {
            alert("Lỗi khi tải dữ liệu.");
        }
    });
}

</script>
