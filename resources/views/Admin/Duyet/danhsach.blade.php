@extends('Admin.main')
@section('content')
    <div class="container">
        <h1>Danh sách ủng hộ hàng</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên người ủng hộ</th>
                <th>Đợt lũ lụt</th>
                <th>Thời gian ủng hộ</th>
                <th>Trạng thái phê duyệt</th>
                <th>Chi tiết</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ungHoList as $ungHo)
                <tr>
                    <td>{{$ungHo->idUngHo}}</td>
                    @if ($ungHo->idNguoiDung==1)
                        <td>Khách vãng lai</td>
                    @else
                        <td>{{$ungHo->tenNguoiDung}}</td>
                    @endif

                    <td>{{$ungHo->tenDotLuLut}}</td>
                    <td>{{$ungHo->thoiGianUngHo}}</td>
                    <td>{{$ungHo->trangThaiPheDuyet}}</td>
                    <td>
                        <a class="btn btn-primary btn-chi-tiet" href="/chitietungho?id={{$ungHo->idUngHo}}">Chi tiết</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('footer')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('.btn-chi-tiet').click(function() {
                var idUngHo = $(this).data('id');
                window.location.href = '/ung-ho/' + idUngHo;
            });
        });
    </script>
@endsection
