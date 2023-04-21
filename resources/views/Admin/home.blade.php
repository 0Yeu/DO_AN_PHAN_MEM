@extends('admin.main')
@section('head')
    <script src="ckedit/ckeditor.js"></script>
@endsection
@section('content')
    Home Page
@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection
