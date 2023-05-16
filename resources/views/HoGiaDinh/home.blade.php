@extends('HoGiaDinh.main')
@section('head')
    <script src="ckedit/ckeditor.js"></script>
    <style>
        .card-text+p{
            display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 3;overflow: hidden;text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/template/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection

