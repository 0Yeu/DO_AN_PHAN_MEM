{{--@extends('Home.main')--}}
{{--@section('head')--}}
{{--    <script src="ckedit/ckeditor.js"></script>--}}
{{--    <style>--}}
{{--        .card-text+p{--}}
{{--            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--        <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">--}}
{{--    </div>--}}

{{--    <div class="container my-5">--}}
{{--        <div class="row">--}}
{{--            <?php $i=0 ?>--}}
{{--            @foreach($BaiDangs as $baiDang)--}}
{{--                <div class="col-lg-4 mb-4">--}}
{{--                    <div class="card h-100">--}}
{{--                        <div class="card-img-top">--}}
{{--                            <img src="{{$baiDang->hinhAnh}}" class="img-fluid" alt="..." style="height: 200px;scale: inherit">--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{$baiDang->tenDotCuuTro}}</h5>--}}
{{--                            <p class="card-text">{!! $baiDang->noiDung !!}</p>--}}
{{--                            <p class="card-text">{{ $baiDang->soTien }}</p>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="btn btn-primary">Chi tiết</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="card-tools float-right">--}}
{{--            <ul class="pagination pagination-sm">--}}
{{--                @if ($BaiDangs->onFirstPage())--}}
{{--                    <li class="disabled"><span class="page-link">&laquo;</span></li>--}}
{{--                @else--}}
{{--                    <li class="page-item" ><a class="page-link" href="{{ $BaiDangs->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}
{{--                @endif--}}


{{--                @if ($BaiDangs->hasMorePages())--}}
{{--                    <li class="page-item"><a class="page-link" href="{{ $BaiDangs->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
{{--                @else--}}
{{--                    <li class="disabled"><span class="page-link">&raquo;</span></li>--}}
{{--                @endif--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
{{--@section('footer')--}}
{{--    <script>--}}
{{--        CKEDITOR.replace( 'content' );--}}
{{--    </script>--}}
{{--@endsection--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Cứu trợ lũ lụt</title>
    <style>
        .card-text+p{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis;height: 70px!important;max-height: 70px;
        }
        .card-body+h3{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;height: 70px!important; ;max-height: 70px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
{{--            <a class="navbar-brand" href="#">Cứu Trợ Lũ Lụt</a>--}}
            {{--             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--            <span class="navbar-toggler-icon"></span>--}}
            {{--          </button>--}}
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="navbar-brand" aria-current="page" href="/">Cứu Trợ Lũ Lụt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/DangKyUngHo">Đăng ký ủng hộ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/danhsachungho">Danh sách ủng hộ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <a class="nav-link" href="/login"><button class="btn btn-primary" type="submit">Đăng nhập</button></a>
            </div>
        </div>
    </nav>
</header>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/images/1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/images/2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="/images/3.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <marquee behavior="" direction="hh">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Quisquam deleniti iusto, sequi, modi, architecto consequatur enim praesentium reiciendis soluta
                    quam quidem molestiae explicabo laborum facere. Dignissimos iure ut dolorem assumenda molestias
                    blanditiis quisquam consequatur ipsa quasi, reprehenderit consectetur dolorum cupiditate?
                </marquee>
            </div>

        </div>
    </div>
    <div class="d-flex ">
        <h2 class=" text-danger">*</h2>
        <h2>Tin mới nhất!</h2>
    </div>
    <div class="row">
        @foreach($BaiDangs as $baiDang)
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <img src="{{$baiDang->hinhAnh}}" class="img-fluid" alt="..." style="height: 200px;scale: inherit">
                    </div>
                    <div class="card-body">
                        <h3>{{$baiDang->tenDotCuuTro}}</h3>
                        <p class="card-text">{!! $baiDang->noiDung !!}</p>
                    </div>
                    <div class="card-footer">
                        <p>{{$baiDang->ngayBatDau}}
                        <div class="text-end">
                            <a href="#" class="text-primary">Xem chi tiết</a>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
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
    <div class="row mt-3">
        <h2>Tin phổ biến</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <img src="/images/4.png" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3>Đợt lũ lụt A</h3>
                        <p style="text-align:justify;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est atque natus
                            doloremque nam nulla eveniet repudiandae at inventore veritatis.
                        </p>
                    </div>
                    <div class="card-footer">
                        <p>04/04/2023-30/04/2023
                        <div class="text-end">
                            <u class="text-primary">Xem chi tiết</u>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <img src="/images/4.png" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3>Đợt lũ lụt A</h3>
                        <p style="text-align:justify;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est atque natus
                            doloremque nam nulla eveniet repudiandae at inventore veritatis.
                        </p>
                    </div>
                    <div class="card-footer">
                        <p>04/04/2023-30/04/2023
                        <div class="text-end">
                            <u class="text-primary">Xem chi tiết</u>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <img src="/images/4.png" class="img-fluid">
                    </div>
                    <div class="card-body">
                        <h3>Đợt lũ lụt A</h3>
                        <p style="text-align:justify;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est atque natus
                            doloremque nam nulla eveniet repudiandae at inventore veritatis.
                        </p>
                    </div>
                    <div class="card-footer">
                        <p>04/04/2023-30/04/2023
                        <div class="text-end">
                            <u class="text-primary">Xem chi tiết</u>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer mt-auto py-3 bg-dark">
    <div class="container">
        <span class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Distinctio obcaecati consequatur, animi illum omnis iusto aspernatur sit at esse odio.</span>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</html>
