@extends('Admin.main')
@section('content')
    <a href="/admin/mucDoThietHai/addMucDoThietHai" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm mức độ thiệt hại</a>
    <table class="table table table-striped" >
        <thead class="card-header" style="background: #00bb00; margin-top: 20px">
        <tr class="">
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã mức độ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Loại mức độ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Ghi chú</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $item)
            <tr>
                <td>{{ $item->idMucDoThietHai }}</td>
                <td>{{ $item->tenMucDo}}</td>
                <td>{!! $item->ghiChu !!}</td>
                <td>
                    <a class="btn btn-warning" href="/admin/mucDoThietHai/editMucDoThietHai?idMucDoThietHai={{$item->idMucDoThietHai}}">Chỉnh sửa</a>
                    <a class="btn btn-danger" href="/admin/mucDoThietHai/destroy?idMucDoThietHai={{$item->idMucDoThietHai}}">Xóa
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
