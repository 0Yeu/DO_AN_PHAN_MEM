<table class="table table table-striped" >
    <thead class="card-header" style="background: #00bb00; margin-top: 20px">
    <tr class="">
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Họ tên</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Giới tính</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Email</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Ngày sinh</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Địa chỉ</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">SĐT</th>
        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Quyền</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menus as $item)
        <tr>
            <td>{{ $item->hoTen }}</td>
            <td>{{ $item->gioiTinh}}</td>
            <td>{!! $item->Email !!}</td>
            <td>{!! $item->ngaySinh !!}</td>
            <td>{!! $item->diaChi !!}</td>
            <td>{!! $item->soDT !!}</td>
            <td>
                <select class="form-control" id="selectIDDM" name="idQuyen" onchange="update(this)">
                    @foreach ($dlls as $id)
                        @if($id->idQuyen==$item->idQuyen)
                            <option value="{{ $id->idQuyen }}" data-id="{{ $item->idNguoiDung }}" selected>{{$id->tenQuyen}}</option>
                        @else
                            <option value="{{ $id->idQuyen }}" data-id="{{ $item->idNguoiDung }}">{{$id->tenQuyen}}</option>
                        @endif
                    @endforeach
                </select>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
