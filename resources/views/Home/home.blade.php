<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Cứu trợ lũ lụt</title>
    <style>
        .card-text+p {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 70px !important;
            max-height: 70px;
        }

        .card-body+h3 {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            text-overflow: ellipsis;
            height: 70px !important;
            ;
            max-height: 70px;
        }
    </style>

    @if (\Illuminate\Support\Facades\Auth::check())
        @if (\Illuminate\Support\Facades\Auth::user()->idQuyen == 1)
            <script>
                window.location.href = "/admin";
            </script>
        @elseif(\Illuminate\Support\Facades\Auth::user()->idQuyen == 2)
            <script>
                window.location.href = "/CTV";
            </script>
        @elseif(\Illuminate\Support\Facades\Auth::user()->idQuyen == 3)
            <script>
                window.location.href = "/HoGiaDinh/KhaiBaoThietHai";
            </script>
        @endif
    @endif
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
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
                        @if (\Illuminate\Support\Facades\Auth::check())

                            @if (\Illuminate\Support\Facades\Auth::user()->idQuyen == 3)
                                <li class="nav-item">
                                    <a class="nav-link" href="/HoGiaDinh/KhaiBaoThietHai">Khai báo thiệt hại</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="/HoGiaDinh/KhaiBaoThietHai">Khai báo thiệt
                                        hại</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/HoGiaDinh/KhaiBaoThietHai">Khai báo thiệt hại</a>
                            </li>
                        @endif
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    @if (\Illuminate\Support\Facades\Auth::check())
                        @if (\Illuminate\Support\Facades\Auth::user()->idQuyen == 4)
                            <a class="navbar-brand" aria-current="page"
                                style="margin-right: 0px!important;margin-left: 16px"
                                href="/">{{ \Illuminate\Support\Facades\Auth::user()->hoTen }}</a>
                            <a class="nav-link" href="/logout"><button class="btn btn-danger"
                                    style="margin-left: 0px!important;" type="submit">Đăng xuất</button></a>
                        @else
                            <a class="nav-link" href="/logout"><button class="btn btn-danger" type="submit">Đăng
                                    xuất</button></a>
                        @endif
                    @else
                        <a class="nav-link" href="/login"><button class="btn btn-primary" type="submit">Đăng
                                nhập</button></a>
                    @endif
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
            <span class="visually-hidden">Trang trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trang sau</span>
        </button>
    </div>
    @include('admin.alert')
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <marquee behavior="" direction="hh">Trái tim gắn kết, mạnh mẽ vượt lũ lụt, ân ái thắp sáng hy
                        vọng. Đoàn kết khắc phục, hướng tới tương lai sáng, môi trường hồi sinh, đời sống thịnh vượng,
                        nhân văn vươn xa, để tình yêu lan tỏa khắp muôn nơi!
                    </marquee>
                </div>
                <div class="container my-5">
                    <div class="row">
                        <?php $i = 0; ?>
                        @foreach ($BaiDangs as $baiDang)
                            <div class="col-lg-4 mb-4">
                                <div class="card h-100 w-100">
                                    <div class="card-img-top" style="height: 200px;width: 100%; overflow: hidden;">
                                        <img src="{{ $baiDang->hinhAnh }}" class="img-fluid" alt="..."
                                            style="height: 200px;width: 100%;object-fit: cover;">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $baiDang->tenDotCuuTro }}</h5>
                                        <p class="card-text">{!! $baiDang->noiDung !!}</p>
                                        <p class="card-text">{!! $baiDang->tenDotLuLut !!}</p>
                                        <div class="card-text">
                                            <div class="row">
                                                <div class="col-sm">
                                                    Ngày kết thúc
                                                </div>
                                                <div class="col-sm">
                                                    <p style="text-align: right;margin: 0;padding: 0">
                                                        {{ $baiDang->ngayKetThuc }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    Lượt ủng hộ
                                                </div>
                                                <div class="col-sm">
                                                    @php
                                                        $tongTien = 0;
                                                        $tongLuotUH = 0;
                                                    @endphp
                                                    @foreach ($ungHo as $uh)
                                                        @if ($uh->idDotLuLut == $baiDang->idDotLuLut)
                                                            @php $tongLuotUH++ @endphp
                                                            @foreach ($CTUHT as $u)
                                                                @if ($u->idUngHo == $uh->idUngHo)
                                                                    @php $tongTien=$tongTien+$u->tienThucNhan @endphp
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <p style="text-align: right;margin: 0;padding: 0">
                                                        {{ $tongLuotUH }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ ($tongTien / $baiDang->soTien) * 100 }}%;"
                                                aria-valuenow="{{ ($tongTien / $baiDang->soTien) * 100 }}%"
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ ($tongTien / $baiDang->soTien) * 100 }}%</div>
                                        </div>
                                        <div class="row d-flex">
                                            <div class="col-sm">
                                                {{ $tongTien }}
                                            </div>
                                            <div class="col-sm float-right">
                                                <p style="text-align: right;margin: 0;padding: 0">
                                                    {{ $baiDang->soTien }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/DangKyUngHo" class="btn btn-outline-success"
                                        style="margin: 10% 10% 10% 10%; ">Ủng hộ</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-tools float-right">
                        <ul class="pagination pagination-sm">
                            @if ($BaiDangs->onFirstPage())
                                <li class="disabled"><span class="page-link">&laquo;</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $BaiDangs->previousPageUrl() }}"
                                        rel="prev">&laquo;</a></li>
                            @endif
                            @if ($BaiDangs->hasMorePages())
                                <li class="page-item"><a class="page-link" href="{{ $BaiDangs->nextPageUrl() }}"
                                        rel="next">&raquo;</a></li>
                            @else
                                <li class="disabled"><span class="page-link">&raquo;</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <footer class="py-3 my-4 bg-dark ">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-white">About</a></li>
                </ul>
                <p class="text-center text-white">© 2022 Company, Inc</p>
            </footer>
        </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>
