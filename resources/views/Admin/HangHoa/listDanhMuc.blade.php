@extends('Admin.main')
@section('content')
    <a href="/admin/hanghoa/addDanhMuc" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm Hàng cứu trợ</a>
    <div class="form-group">
        <label for="idDanhMuc">Danh mục</label>
        <select class="form-control" id="selectIDDM" name="idDanhMuc" onchange="filterData()">
            <option value="-1">Tất cả</option>
            @foreach ($dlls as $id)
                <option value="{{ $id->idDanhMuc }}">{{ $id->tenDanhMuc }}</option>
            @endforeach
        </select>
    </div>
    <div id="table-data">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hàng</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên danh mục</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên hàng</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Đơn vị tính</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng còn</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mô tả</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->idHangCuuTro }}</td>
                    <td>{{ $item->tenDanhMuc}}</td>
                    <td>{{ $item->tenHangCuuTro }}</td>
                    <td>{{ $item->donViTinh}}</td>
                    <td>{{ $item->soLuongCon }}</td>
                    <td>{!! $item->moTa !!}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idHangCuuTro}}">
                            <span class="material-symbols-outlined">
                            edit
                        </span></a>
                        <a class="btn btn-danger" href="/admin/hanghoa/destroy?idHangCuuTro={{$item->idHangCuuTro}}"><span class="material-symbols-outlined">
                        delete
                        </span>
                        </a>
                        <a class="btn btn-info" href="#">
                        <span class="material-symbols-outlined">
                        history
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
        var url = "/admin/hanghoa/filterDanhMuc?idDanhMuc=" + idDanhMuc;

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
