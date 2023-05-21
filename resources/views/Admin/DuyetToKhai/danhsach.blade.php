@extends('Admin.main')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="selectedDLL">Đợt lũ lụt</label>
                <select class="form-control" id="selectedDLL" name="idXa" onchange="filterData()">
                    <option value="-1">Tất cả</option>
                    @foreach ($dlls as $id)
                        <option value="{{ $id->idDotLuLut }}">{{$id->tenDotLuLut}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="selectedIDXa">Xã</label>
                <select class="form-control" id="selectedIDXa" name="idXa" onchange="filterData()">
                    <option value="-1">Tất cả</option>
                    @foreach ($xaList as $id)
                        <option value="{{ $id->idXa }}">{{$id->tenXa}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="selectIDDM">Trạng thái</label>
                <select class="form-control" id="selectIDDM" name="idLoaiHoGD" onchange="filterData()">
                    <option value="-1">Tất cả</option>
                    <option value="Chờ phê duyệt">Chờ phê duyệt</option>
                    <option value="Từ chối">Từ chối</option>
                    <option value="Đã phê duyệt">Đã phê duyệt</option>
                </select>
            </div>
        </div>
    </div>
    <form action="/pheduyettokhaiall" method="POST" onsubmit="return validateForm()">
        <div id="table-data">
            <table class="table table table-striped" >
                <thead>
                <tr class="">
                    <th><input type="checkbox" id="selectAll"></th>
                    <th >Đợt lũ lụt</th>
                    <th >Mã hộ gia đình</th>
                    <th >Thiệt hại về người</th>
                    <th >Ước tính tổng thiệt hại</th>
                    <th >Mức độ thiệt hại</th>
                    <th >Trạng thái</th>
                    <th >Chi tiết</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menus as $item)
                    <tr>
                        <td><input type="checkbox" name="check[]" value="{{$item->idThietHai}}"></td>
                        <input type="hidden" name="idThietHai[]" value="{{$item->idThietHai}}">
                        <td>{{ $item->tenDotLuLut }}</td>
                        <td>{{ $item->idHoGiaDinh}}</td>
                        <td>{{ $item->thietHaiVeNguoi}}</td>
                        <td>{{ $item->uocTinhTongThietHai}}</td>
                        <td>{{ $item->tenMucDoThietHai }}</td>
                        <td>{{ $item->trangThaiPheDuyet}}</td>
                        <td>
                            {{-- <a class="btn btn-warning" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Chi tiết</a>
                            <a class="btn btn-success" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Phê duyệt</a>
                            <a class="btn btn-danger" href="/admin/hanghoa/editDanhMuc?idHangCuuTro={{$item->idThietHai}}">Từ chối</a> --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <button class="btn btn-success" type="submit" name="pheduyetall">Phê duyệt</button>
        <button class="btn btn-danger" type="submit" name="tuchoiall">Từ chối</button>
        @csrf
    </form>
    <div class="card-tools float-right">
        <ul class="pagination pagination-sm mt-3">
            @if ($menus->onFirstPage())
                <li class="disabled"><span class="page-link">Trang trước</span></li>
            @else
                <li class="page-item" ><a class="page-link" href="{{ $menus->previousPageUrl() }}" rel="prev">Trang trước</a></li>
            @endif


            @if ($menus->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $menus->nextPageUrl() }}" rel="next">Trang sau</a></li>
            @else
                <li class="disabled"><span class="page-link">Trang sau</span></li>
            @endif
        </ul>
    </div>
@endsection
@section('footer')
    <script>
        function loadScript(){
            var selectAllCheckbox = document.getElementById("selectAll");
            var checkboxes = document.getElementsByName("check[]");

            selectAllCheckbox.addEventListener("change", function() {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = selectAllCheckbox.checked;
                }
            });
        }
        $(document).ready(function() {
            loadScript();
        });
        function validateForm() {
            var checkboxes = document.getElementsByName("check[]");
            var isChecked = false;

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    isChecked = true;
                    break;
                }
            }

            if (!isChecked) {
                alert("Vui lòng chọn ít nhất một checkbox.");
                return false; // Ngăn chặn việc gửi form
            }

            return true; // Cho phép gửi form
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function filterData() {
            var idDanhMuc = document.getElementById("selectIDDM").value;
            var idXa = document.getElementById("selectedIDXa").value;
            var idDotLuLut = document.getElementById("selectedDLL").value;
            var url = "/filterToKhai?idXa=" + idXa+"&idPheDuyet="+idDanhMuc+"&idDotLuLut="+idDotLuLut;
            console.log(url);
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                success: function(data) {
                    $("#table-data").html(data);
                    loadScript();
                    console.log(data);
                },
                error: function() {
                    alert("Lỗi khi tải dữ liệu.");
                }
            });
        }
    </script>
@endsection
