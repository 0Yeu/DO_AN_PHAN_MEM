@extends('Admin.main')
@section('head')
@endsection
@section('content')
    <div class="container" style="margin-top: 100px">
        <h1 STYLE="text-align: center">Đăng ký ủng hộ</h1>
        <form action="/GuiUngHo" method="POST" id="formgui">
            <div class="form-group">
                <label>Tên người ủng hộ:</label>
                @if (\Illuminate\Support\Facades\Auth::check())
                    <p>{{\Illuminate\Support\Facades\Auth::user()->hoTen}}</p>
                @else
                    <p style="color: red">*Hiện bạn chưa đăng nhập. Thông tin sẽ được lưu thành khách vãng lai </p>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Đợt lũ lụt:</label>
                <select class="hanghoa-select form-control" data-search="true" name="dotlulut">
                    @if($DotLuLut->count() ==0)
                        <option>Không có đợt ủng hộ nào đang mở</option>
                    @else
                        @foreach($DotLuLut as $dll)
                            <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>
                        @endforeach
                    @endif

                </select>
            </div>

            <div class="form-group">
                <label for="value">Hàng hóa ủng hộ:</label>
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th style="width: 400px;">Tên hàng hóa</th>
                        <th>Số lượng</th>
                        <th><button type="button" class="btn btn-success btn-sm btn-add">+</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <label for="name">Số tiền ủng hộ:</label>
                <input type="number" class="form-control" id="money" name="money" value="0" min="0" step="1000" required>
            </div>
            <div class="form-group">
                <label for="date">Ngày ủng hộ:</label>
                <input type="date" class="form-control" id="date" name="thoigian" value="{{ date('Y-m-d') }}" required>
            </div>
            @if($DotLuLut->count() ==0)
                <p style="color: red">*Không có đợt ủng hộ nào đang mở</p>
            @else
                <button type="submit" class="btn btn-primary">Gửi tờ khai</button>
            @endif

            @csrf
        </form>

    </div>
@endsection
@section('footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
            var idHangCuuTro = $(selected).data('id');
            var soLuongThucNhan = $(selected).closest('tr').find('input[name="soLuongThucNhan[]"]').val();
            console.log(idHangCuuTro, soLuongThucNhan);

            // Gửi Ajax request với CSRF token
            $.ajax({
                url: '/phe-duyet',
                method: 'POST',
                data: {
                    _token: csrfToken, // Thêm CSRF token vào dữ liệu gửi đi
                    idHangCuuTro: idHangCuuTro,
                    soLuongThucNhan: soLuongThucNhan,
                    idUngHo: {{$idUngHo}}
                },
                success: function(response) {
                    // Xử lý thành công
                    console.log('Phê duyệt thành công!');
                    var tr = $(selected).closest('tr');
                    tr.find('.trang-thai-phe-duyet').text('Đã duyệt').css('color', 'black');
                    tr.find('input[name="soLuongThucNhan[]"]').text(soLuongThucNhan);

                    // Cập nhật trạng thái và hiển thị thông tin đã cập nhật nếu cần
                    // ...
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi (nếu có)

                }
            });
        }
    </script>
    <script>
        // Xử lý khi ấn phê duyệt tất cả
        $(document).ready(function() {
            $('#btn_pheDuyetAll').click(function() {
                var soLuongThucNhanList = [];
                var idHangCuuTroList = [];

                // Lặp qua tất cả các input số lượng thực nhận
                $('input[name="soLuongThucNhan[]"]').each(function() {
                    var soLuongThucNhan = $(this).val();
                    console.log(soLuongThucNhan);
                    soLuongThucNhanList.push(soLuongThucNhan);
                });
                $('input[name="idHangCuuTro[]"]').each(function() {
                    var idHangCuuTro = $(this).val();
                    idHangCuuTroList.push(idHangCuuTro);
                });
                console.log(soLuongThucNhanList,idHangCuuTroList);
                // Gửi Ajax request với CSRF token
                $.ajax({
                    url: '/phe-duyet-all',
                    method: 'POST',
                    data: {
                        _token: csrfToken, // Thêm CSRF token vào dữ liệu gửi đi
                        idUngHo: {{$idUngHo}},
                        soLuongThucNhanList: soLuongThucNhanList,
                        idHangCuuTroList:idHangCuuTroList
                    },
                    success: function(response) {
                        // Xử lý thành công
                        console.log('Phê duyệt tất cả thành công!');
                        $('.trang-thai-phe-duyet').text('Đã duyệt').css('color', 'black');
                        $('input[name="soLuongThucNhan[]"]').each(function(index) {
                            $(this).val(soLuongThucNhanList[index]);
                        });

                        // Cập nhật trạng thái và hiển thị thông tin đã cập nhật nếu cần
                        // ...
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.log(error);

                    }
                });
            });
        });
    </script>
@endsection
