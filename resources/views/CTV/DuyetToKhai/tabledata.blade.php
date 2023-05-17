<table class="table table table-striped" >
    <thead>
    <tr class="">
        <th><input type="checkbox" id="selectAll"></th>
        <th >Đợt lũ lụt</th>
        <th >Mã hộ gia đình</th>
        <th >Thiệt hại về người</th>
        <th >Ước tính tổng thiệt hại</th>
        <th >Mức độ thiệt hại</th>
        <th >Trạng thái</th>
        <th >Chi tiết</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menus as $item)
        <tr>
            <td><input type="checkbox" name="check[]" value="{{$item->idThietHai}}"></td>
            <input type="hidden" name="idThietHai[]" value="{{$item->idThietHai}}">
            <td>{{ $item->tenDotLuLut }}</td>
            <td>{{ $item->idHoGiaDinh}}</td>
            <td>{{ $item->thietHaiVeNguoi}}</td>
            <td>{{ $item->uocTinhTongThietHai}}</td>
            <td>{{ $item->tenMucDoThietHai }}</td>
            <td>{{ $item->trangThaiPheDuyet}}</td>
            <td>
                <a class="btn btn-warning" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Chi tiết</a>
                <a class="btn btn-success" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Phê duyệt</a>
                <a class="btn btn-danger" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Từ chối</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
