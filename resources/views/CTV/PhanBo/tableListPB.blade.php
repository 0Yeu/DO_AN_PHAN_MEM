<table class="table table table-striped" >
    <thead class="card-header" style="background: #00bb00; margin-top: 20px">
    <tr class="">
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hộ</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mức độ thiệt hại</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái phân bổ</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">#</th>
    </tr>
    </thead>
    <tbody>
    @foreach($hoGiaDinhChuaPhanBo as $item)
        <tr>
            <td>{{ $item->idHoGiaDinh }}</td>
            <td>{{ $item->tenMucDo}}</td>
            <td>Chưa phân bổ</td>
            <td>
                <a href="/chitietphanbo?id={{$item->idThietHai}}">Chi tiết</a>
            </td>
        </tr>
    @endforeach
    @foreach($hoGiaDinhDaPhanBo as $item)
        <tr>
        <tr>
            <td>{{ $item->idHoGiaDinh }}</td>
            <td>{{ $item->tenMucDo}}</td>
            <td>Đã phân bổ</td>
            <td>
            </td>
        </tr>
        </tr>
    @endforeach
    </tbody>
</table>
