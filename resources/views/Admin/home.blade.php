@extends('admin.main')
@section('head')
    <script src="ckedit/ckeditor.js"></script>
    <style>
        .card-text+p{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <div class="container my-5">
        <div class="row">
            <?php $i=0 ?>
            @foreach($BaiDangs as $baiDang)
                <div class="col-lg-3 mb-3">
                    <div class="card h-100">
                        <img src="{{$baiDang->hinhAnh}}" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$baiDang->tenDotCuuTro}}</h5>
                            <p class="card-text">{!! $baiDang->noiDung !!}</p>
                        </div>
                        <a href="/admin/taoBaiDang/edt?id={{$baiDang->idBaiDang}}" class="btn btn-primary">Sửa bài đăng</a>
                        <a href="/admin/taoBaiDang/del?id={{$baiDang->idBaiDang}}" class="btn btn-danger">Xóa bài đăng</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
