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
