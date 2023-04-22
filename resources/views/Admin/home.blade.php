@extends('admin.main')
@section('head')
    <script src="ckedit/ckeditor.js"></script>
@endsection
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <div class="container my-5">
        <div class="row">
            <?php $i=0 ?>
            @foreach($BaiDangs as $baiDang)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$baiDang->tenDotCuuTro}}</h5>
                            <p class="card-text">{{$baiDang->noiDung}}.</p>
                            <a href="#" class="btn btn-primary">Xem thêm</a>
                        </div>
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
