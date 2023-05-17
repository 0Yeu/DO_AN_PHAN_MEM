@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="">Đợt lũ lụt</label>
                <select class="form-control" id="selectIDDM" name="idDotLuLut" onchange="filterData()">
                    @foreach ($dlls as $id)
                        @if($menu->idDotLuLut==$id->idDotLuLut)
                            <option value="{{ $id->idDotLuLut }}" selected>{{ $id->tenDotLuLut }}</option>
                        @else
                            <option value="{{ $id->idDotLuLut }}">{{ $id->tenDotLuLut }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Tên mức độ</label>
                <input type="text" name="tenMucDo" class="form-control" id="" value="{{$menu->tenMucDo}}">
            </div>
            <div class="form-group">
                <label for="">Ghi chú</label>
                <textarea class="form-control" name="ghiChu" id="content" placeholder="Mô tả">{{$menu->ghiChu}}</textarea>
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
