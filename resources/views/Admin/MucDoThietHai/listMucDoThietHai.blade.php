@extends('Admin.main')
@section('content')
    <a href="/admin/mucDoThietHai/addMucDoThietHai" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm mức độ thiệt hại</a>
    <div class="form-group">
        <label for="idDanhMuc">Đợt lũ lụt</label>
        <select class="form-control" id="selectIDDM" name="idDanhMuc" onchange="filterData()">
            <option value="-1">Tất cả</option>
            @foreach ($dlls as $id)
                <option value="{{ $id->idDotLuLut }}">{{ $id->tenDotLuLut }}</option>
            @endforeach
        </select>
    </div>
    <div id="table-data">
        <table class="table table table-striped" >
            <thead class="card-header" style="background: #00bb00; margin-top: 20px">
            <tr class="">
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã mức độ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Loại mức độ</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên đợt lũ lụt</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Ghi chú</th>
                <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $item)
                <tr>
                    <td>{{ $item->idMucDoThietHai }}</td>
                    <td>{{ $item->tenMucDo}}</td>
                    <td>{{$item->tenDotLuLut}}</td>
                    <td>{!! $item->ghiChu !!}</td>
                    <td>
                        <a class="btn btn-warning" href="/admin/mucDoThietHai/editMucDoThietHai?idMucDoThietHai={{$item->idMucDoThietHai}}"><span class="material-symbols-outlined">
                            edit
                        </span></a>
                        <a class="btn btn-danger" href="/admin/mucDoThietHai/destroy?idMucDoThietHai={{$item->idMucDoThietHai}}"><span class="material-symbols-outlined">
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script>
        function filterData() {
            var idDanhMuc = document.getElementById("selectIDDM").value;
            var url = "/admin/PhanBo/filterMDTHS?idDLL=" + idDanhMuc;
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
