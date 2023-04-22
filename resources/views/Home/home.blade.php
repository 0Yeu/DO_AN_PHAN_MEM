@extends('Home.main')
@section('head')
    <script src="ckedit/ckeditor.js"></script>
@endsection
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 1</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 1.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 2</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 2.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 3</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 3.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 4</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 4.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 5</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 5.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Tiêu đề bài đăng 6</h5>
                        <p class="card-text">Mô tả ngắn gọn về bài đăng 6.</p>
                        <a href="#" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection

