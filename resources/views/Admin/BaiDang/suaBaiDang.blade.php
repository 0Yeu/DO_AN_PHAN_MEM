@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')


    <form enctype="multipart/form-data" action="/admin/taoBaiDang/edt" method="POST" >
        <div class="card-body">
            <div class="form-group">
                <label for="">Mã bài đăng</label>
                <input type="text" name="idBaiDang" class="form-control" id="" value="{{$menu->idBaiDang}}" readonly placeholder="Tên đợt kêu gọi">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên đợt kêu gọi</label>
                        <input type="text" name="tenDotCuuTro" class="form-control" id="" value="{{$menu->tenDotCuuTro}}" placeholder="Tên đợt kêu gọi">
                    </div>
                    <div class="form-group">
                        <label for="">Đợt lũ lụt</label>
                        <select class="form-control" name="idDotLuLut" id="dotLuLut" >
                            @foreach($dlls as $dll)
                                <option  value="{{$dll->idDotLuLut}}">{{$dll->tenDotLuLut}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày Kết thúc</label>
                        <input type="date" name="ngayKetThuc" class="form-control" id="" value="{{$menu->ngayKetThuc}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Ngày bắt đầu</label>
                        <input type="date" name="ngayBatDau" class="form-control" id="" value="{{$menu->ngayBatDau}}">
                    </div>
                    <div class="form-group">
                        <label for="">Số tiền</label>
                        <input type="number" name="soTien" class="form-control" id="" value="{{$menu->soTien}}">
                    </div>
                    <div class="form-group">
                        <label for="hinhanh">Hình ảnh</label>
                        <input type="file" name="hinhanh" class="form-control" id="myFile" accept="image/*">

                        {{--                        <input type="text" style="display: none" id="previewImg" name="data">--}}
                    </div>
                </div>
                <img src="../../{{$menu->hinhAnh}}" id="previewImg" style="max-width: 200px; max-height: 200px;" >
            </div>
            <div class="form-group">
                <label for="">Ghi chú</label>
                <textarea class="form-control" name="ghiChu" id="ghiChu" placeholder="Ghi chú">{{$menu->noiDung}}</textarea>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('ghiChu');
    </script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('previewImg');
                output.src = reader.result;
                output.style.display = "block";
            };
            reader.readAsDataURL(event.target.files[0]);
        }
        document.getElementById('myFile').addEventListener('change', previewImage);
    </script>
@endsection
