@extends('CTV.main')
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
            @foreach ($BaiDangs as $baiDang)
                <div class="col-md-4 mt-3">
                    <div class="card h-100 w-100">
                        <div class="card-header w-100" style="height: 200px;">
                            <img src="{{ $baiDang->hinhAnh }}" class="img-fluid h-100 w-100" style="object-fit: cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $baiDang->tenDotCuuTro }}</h5>
                            <p class="card-text">{!! $baiDang->noiDung !!}</p>
                            <p class="card-text">{{ $baiDang->soTien }}</p>
                        </div>
                        <a href="/admin/taoBaiDang/edt?id={{ $baiDang->idBaiDang }}" class="btn btn-primary">Sửa bài
                            đăng</a>
                        <a href="/admin/taoBaiDang/del?id={{ $baiDang->idBaiDang }}" class="btn btn-danger">Xóa bài đăng</a>
                    </div>
                </div>
            @endforeach
            {{-- @foreach($BaiDangs as $baiDang)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-img-top" style="height: 200px; overflow: hidden;">
                            <img src="{{$baiDang->hinhAnh}}" class="img-fluid" alt="..." style="height: 200px;object-fit: cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$baiDang->tenDotCuuTro}}</h5>
                            <p class="card-text">{!! $baiDang->noiDung !!}</p>
                            <p class="card-text">{{ $baiDang->soTien }}</p>
                        </div>
                        <a href="/admin/taoBaiDang/edt?id={{$baiDang->idBaiDang}}" class="btn btn-primary">Sửa bài đăng</a>
                        <a href="/admin/taoBaiDang/del?id={{$baiDang->idBaiDang}}" class="btn btn-danger">Xóa bài đăng</a>
                    </div>
                </div>
            @endforeach --}}
        </div>
        <div class="card-tools float-right">
            <ul class="pagination pagination-sm">
                @if ($BaiDangs->onFirstPage())
                    <li class="disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item" ><a class="page-link" href="{{ $BaiDangs->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif


                @if ($BaiDangs->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $BaiDangs->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
