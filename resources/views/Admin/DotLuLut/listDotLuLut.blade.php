@extends('Admin.main')
@section('head')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('content')
    <a href="/admin/dotlulut/addDotLuLut" class="btn btn-primary float-right"  style="margin-top: 20px;width: 200px"><i class="fas fa-plus"></i> Thêm đợt lũ</a>
    <table class="table table table-striped" >
        <thead class="card-header" style="background: #00bb00; margin-top: 20px">
        <tr class="">
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã đợt lũ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên đợt lũ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Thời gian xảy ra</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Cho phép ủng hộ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Cho phép khai báo thiệt hại</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Cho phép phân bổ</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $item)
            <tr>
                <td>{{ $item->idDotLuLut }}</td>
                <td>{{ $item->tenDotLuLut}}</td>
                <td>{!! $item->thoiGian !!}</td>
                @if($item->ungHo==1)
                    <td>Không</td>
                @else
                    <td>Có</td>
                @endif
                @if($item->khaiBao==1)
                    <td>Không</td>
                @else
                    <td>Có</td>
                @endif
                @if($item->phanBo==1)
                    <td>Không</td>
                @else
                    <td>Có</td>
                @endif
                <td>
                    <a class="btn btn-warning" href="/admin/dotlulut/editDanhMuc?idDotLuLut={{$item->idDotLuLut}}">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </a>
                    <a class="btn btn-danger" href="/admin/dotlulut/destroy?idDotLuLut={{$item->idDotLuLut}}">
                        <span class="material-symbols-outlined">
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
