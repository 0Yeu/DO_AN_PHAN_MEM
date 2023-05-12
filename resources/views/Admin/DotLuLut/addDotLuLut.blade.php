@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="">Tên đợt lũ</label>
                <input type="text" name="tenDotLuLut" class="form-control" id="" placeholder="Tên đợt lũ">
            </div>
            <div class="form-group">
                <label for="">Ngày xảy ra lũ</label>
                <input type="date" name="thoiGian" class="form-control" id="">
                <!-- <textarea class="form-control" name="content" id="content" placeholder="Mô tả"></textarea> -->
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