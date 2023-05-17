@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="">Tên đợt lũ lụt</label>
                <input type="text" name="tenDotLuLut" class="form-control" id="" value="{{$menu->tenDotLuLut}}">
            </div>
            <div class="form-group">
                <label for="">Ngày xảy ra lũ</label>
                <input type="date" name="thoiGian" class="form-control" id="" value="{{$menu->thoiGian}}">
            </div>
            <div class="form-group">
                <label for="">Cho phép ủng hộ</label>
                <select class="form-control" name="ungHo">
                    <option value="1">Không</option>
                    @if($menu->ungHo!=1)
                        <option value="2" selected>Có</option>
                    @else
                        <option value="2">Có</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Cho phép khai báo</label>
                <select class="form-control" name="KhaiBao">
                    <option value="1">Không</option>
                    @if($menu->khaiBao!=1)
                        <option value="2" selected>Có</option>
                    @else
                        <option value="2">Có</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="">Cho phép phân bổ</label>
                <select class="form-control" name="phanBo">
                    <option value="1">Không</option>
                    @if($menu->phanBo!=1)
                        <option value="2" selected>Có</option>
                    @else
                        <option value="2">Có</option>
                    @endif
                </select>
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
        CKEDITOR.replace('content');
    </script>
@endsection
