@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Chọn hình ảnh:</label>
        <input type="file" name="hinhAnh" id="image">
        <button type="submit">Upload</button>
    </form>

{{--    <form action="" method="POST" enctype="multipart/form-data>--}}
{{--        <div class="card-body">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Tên đợt kêu gọi</label>--}}
{{--                        <input type="text" name="tenDotCuuTro" class="form-control" id="" placeholder="Tên đợt kêu gọi">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Đợt lũ lụt</label>--}}
{{--                        <select class="form-control" name="idDotLuLut" id="dotLuLut" >--}}
{{--                            @foreach($dlls as $dll)--}}
{{--                                <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>--}}
{{--                            @endforeach--}}

{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Ngày Kết thúc</label>--}}
{{--                        <input type="date" name="ngayKetThuc" class="form-control" id="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Ngày bắt đầu</label>--}}
{{--                        <input type="date" name="ngayBatDau" class="form-control" id="">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Số tiền</label>--}}
{{--                        <input type="number" name="soTien" class="form-control" id="">--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Hình ảnh</label>--}}
{{--                        <input type="file" name="hinhAnh" class="form-control" id="" accept="image/*">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="">Ghi chú</label>--}}
{{--                <textarea class="form-control" name="ghiChu" id="ghiChu" placeholder="Ghi chú"></textarea>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /.card-body -->--}}

{{--        <div class="card-footer">--}}
{{--            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--        </div>--}}
{{--        @csrf--}}
{{--    </form>--}}

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('ghiChu');
    </script>
@endsection
