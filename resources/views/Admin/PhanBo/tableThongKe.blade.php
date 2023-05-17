<table class="table table table-striped" >
    <thead class="card-header" style="background: #00bb00; margin-top: 20px">
    <tr class="">
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Mã Hàng</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tên hàng</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Tổng số lượng phân bổ theo dự tính</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số lượng còn trong kho</th>
    </tr>
    </thead>
    <tbody>
    @if($menus->count()>0)
        @foreach($menus as $item)
            <tr {{$item->soLuong>$item->soLuongCon?'style=color:RED;':''}}>
                <td>{{ $item->idHangCuuTro }}</td>
                <td>{{ $item->tenHangCuuTro}}</td>
                <td>{{ $item->soLuong }}</td>
                <td>{{ $item->soLuongCon }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
