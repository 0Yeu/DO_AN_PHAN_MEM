@extends('Admin.main')
@section('content')
    <p>Tổng tiền trong kho:{{$result}}</p>
    <div class="form-group">
        <label for="idDanhMuc">Danh mục</label>
        <select class="form-control" id="selectIDDM" name="idDanhMuc" onchange="filterData()">
            <option value="-1">Tất cả</option>
            @foreach ($dlls as $id)
                <option value="{{ $id->idDotLuLut }}">{{ $id->tenDotLuLut }}</option>
            @endforeach
        </select>
    </div>

    <div id="table-data">
        <form method="POST" action="/phe-duyet-tien-all">
            @csrf
            <table class="table table table-striped" >
                <thead class="card-header" style="background: #00bb00; margin-top: 20px">
                <tr class="">
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Đợt lũ lụt</th>
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Người ủng hộ</th>
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Giá trị</th>
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Thực nhận</th>
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Trạng thái phê duyệt</th>
                    <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $item)
                    <tr>
                        <td>{{ $item->tenDotLuLut }}</td>
                        <td>{{ $item->idNguoiDung==1?'Khách vãng lai':$item->tenNguoiDung}}</td>
                        <td>{{ $item->tienUngHo }}</td>
                        <td><input type="number" name="tienThucNhan[]" value="{{ $item->trangThaiPheDuyet==1?$item->tienUngHo:$item->tienThucNhan}}"></td>
                        <td class="trang-thai-phe-duyet">{{ $item->trangThaiPheDuyet==1?'Chờ phê duyệt':'Đã phê duyệt'}}</td>
                        <td><p id="btnPheDuyet" class="btn btn-success btn-phe-duyet" data-id="{{$item->idCTUngHoTien}}" onclick="pheDuyet(this)">Phê duyệt</p></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->idQuyen<2)--}}
            {{--                <td> <button type="button" class="btn btn-success btn-phe-duyet" id="btn_pheDuyetAll" type="submit" data-id="">Phê duyệt tất cả</button></td>--}}
            {{--            @endif--}}
        </form>
    </div>
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

    <table class="table table table-striped" >
        <thead class="card-header" style="background: #00bb00; margin-top: 20px">
        <tr class="">
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Đợt lũ lụt</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Hộ gia đình</th>
            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Số tiền phân bổ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($phanBoList as $item)
            <tr>
                <td>{{ $item->tenDotLuLut }}</td>
                <td>{{ $item->idHoGiaDinh}}</td>
                <td>{{ $item->soTien }}</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Lấy giá trị CSRF token từ thẻ meta
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Thiết lập CSRF token cho mọi yêu cầu Ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
</script>
<script>
    function pheDuyet(selected) {
        var idCTUngHoTien = $(selected).data('id');
        var tienThucNhan = $(selected).closest('tr').find('input[name="tienThucNhan[]"]').val();
        // Gửi Ajax request với CSRF token
        $.ajax({
            url: '/phe-duyet-tien',
            method: 'POST',
            data: {
                _token: csrfToken, // Thêm CSRF token vào dữ liệu gửi đi
                idCTUngHoTien: idCTUngHoTien,
                tienThucNhan: tienThucNhan,
            },
            success: function(response) {
                // Xử lý thành công
                console.log('Phê duyệt thành công!');
                console.log(response);
                var tr = $(selected).closest('tr');
                tr.find('.trang-thai-phe-duyet').text('Đã phê duyệt').css('color', 'black');
                tr.find('input[name="tienThucNhan[]"]').text(tienThucNhan);
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi (nếu có)
            }
        });
    }
</script>
