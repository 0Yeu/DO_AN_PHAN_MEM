<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết ủng hộ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Chi tiết ủng hộ</h1>
    <table class="table">
        <thead>
        <tr>
            <th>Tên hàng cứu trợ</th>
            <th>Số lượng</th>
            <th>Trạng thái phê duyệt</th>
            <th>Phê duyệt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chiTietList as $chiTiet)
            <tr>
                <td>{{$chiTiet->idHangCuuTro}}</td>
                <td>{{$chiTiet->soLuong}}</td>
                <td>{{$chiTiet->trangThaiPheDuyet}}</td>
                <td>
                    @if($chiTiet->trangThaiPheDuyet == 1)
                        <button class="btn btn-success btn-phe-duyet" data-id="{{$chiTiet->idHangCuuTro}}">Phê duyệt</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        // Xử lý sự kiện khi nhấn nút Phê duyệt
        $('.btn-phe-duyet').click(function(){
            var id = $(this).data('id');
            $.ajax({
                url: '/phe-duyet/' + id,
                type: 'PUT',
                data: {_token: '{{csrf_token()}}'},
                success: function(response){
                    // Thông báo phê duyệt thành công
                    alert('Phê duyệt thành công!');
                    // Cập nhật lại trạng thái phê duyệt của hàng cứu trợ trong bảng
                    $(this).parent().prev().text('Đã phê duyệt');
                },
                error: function(xhr, status, error){
                    // Hiển thị lỗi nếu có
                    alert(xhr.responseText);
                }
            });
        });
    });
</script>
