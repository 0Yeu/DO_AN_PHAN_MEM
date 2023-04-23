@extends('Admin.main')
@section('content')
    <a href="/admin/hanghoa/addDanhMuc" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm Hàng cứu trợ</a>
    <table class="table table table-striped" >
        <thead class="card-header" style="background: #00bb00; margin-top: 20px">
        <tr class="">
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hàng</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã danh mục</th>
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
                <td>{{ $item->idDanhMuc}}</td>
                <td>{{ $item->tenHangCuuTro }}</td>
                <td>{{ $item->donViTinh}}</td>
                <td>{{ $item->soLuongCon }}</td>
                <td>{!! $item->moTa !!}</td>
                <td>
                    <a class="btn btn-warning" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idHangCuuTro}}">Chỉnh sửa</a>
                    <a class="btn btn-danger" href="/admin/hanghoa/destroy?idHangCuuTro={{$item->idHangCuuTro}}">Xóa
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
