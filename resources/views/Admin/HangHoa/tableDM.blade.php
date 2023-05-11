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
