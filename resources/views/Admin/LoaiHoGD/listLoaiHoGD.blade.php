@extends('Admin.main')
@section('content')
    @include('admin.alert')
    <a href="/admin/loaiHoGD/addLoaiHoGD" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm loại hộ gia đình</a>
    <table class="table table table-striped" >
        <thead class="card-header" style="background: #00bb00; margin-top: 20px">
        <tr class="">
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã loại</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Loại hộ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $item)
            <tr>
                <td>{{ $item->idLoaiHoGD }}</td>
                <td>{{ $item->LoaiHoGD}}</td>
                <td>
                    <a class="btn btn-warning" href="/admin/loaiHoGD/editLoaiHoGD?idLoaiHoGD={{$item->idLoaiHoGD}}"><span class="material-symbols-outlined">
                            edit
                        </span></a>
                    <a class="btn btn-danger" href="/admin/loaiHoGD/destroy?idLoaiHoGD={{$item->idLoaiHoGD}}"><span class="material-symbols-outlined">
                        delete
                        </span>
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
