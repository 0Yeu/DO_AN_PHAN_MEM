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
