@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" name="tenDanhMuc" class="form-control" id="" placeholder="Tên danh mục">
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea class="form-control" name="content" id="content" placeholder="Mô tả"></textarea>
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
