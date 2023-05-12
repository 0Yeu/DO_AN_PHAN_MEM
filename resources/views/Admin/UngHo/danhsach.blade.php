<!DOCTYPE html>
<html>
<head>
    <title>Danh sách ủng hộ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Danh sách ủng hộ</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Thời gian ủng hộ</th>
            <th>Trạng thái phê duyệt</th>
            <th>Chi tiết</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ungHoList as $ungHo)
            <tr>
                <td>{{$ungHo->idUngHo}}</td>
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
</body>
</html>
