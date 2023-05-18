@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form enctype="multipart/form-data" action="" method="POST" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên hàng hóa</label>
                        <input type="text" name="tenHangCuuTro" class="form-control" id="" placeholder="Tên hàng hóa">
                    </div>
                    <div class="form-group">
                        <label for="">Loại hàng hóa</label>
                        <select class="form-control" name="idDanhMuc" id="dotLuLut" >
                            @foreach($dlls as $dll)
                                <option  value="{{$dll->idDanhMuc}}">{{$dll->tenDanhMuc}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Đơn vị tính</label>
                        <input type="text" name="donViTinh" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng trong kho</label>
                        <input type="number" name="soLuongCon" class="form-control" id="">
                    </div>
                </div>
                <img src="" id="previewImg" style="max-width: 200px; max-height: 200px;display: none" >
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea class="form-control" name="moTa" id="ghiChu" placeholder="Mô tả"></textarea>
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
