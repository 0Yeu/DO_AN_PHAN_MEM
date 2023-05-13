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
                        <label for="">Loại hộ gia đình</label>
                        <select class="form-control" name="idLoaiHoGD" id="" >
                            @foreach($dlls as $dll)
                                <option  value="{{$dll->idLoaiHoGD}}">{{$dll->LoaiHoGD}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" name="diaChi" class="form-control" id="" placeholder="Địa chỉ">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Số lượng thành viên</label>
                        <input type="number" name="soLuongThanhVien" class="form-control" id="">
                    </div>
                </div>
                <img src="" id="previewImg" style="max-width: 200px; max-height: 200px;display: none" >
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
@endsection
