<div class="form-group">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="choice" id="coRadioButton" value="co" {{$result->count() > 0 && $result[0]->thietHaiVeNguoi != 0 ? 'checked' : ''}} >
        <label class="form-check-label" for="coRadioButton">
            Có
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="choice" id="khongRadioButton" {{$result->count() == 0||($result->count() > 0 && $result[0]->thietHaiVeNguoi == 0) ? 'checked' : ''}} value="khong">
        <label class="form-check-label" for="khongRadioButton">
            Không
        </label>
    </div>
</div>
<div class="form-group">
    <div id="inputContainer" style="display:{{$result->count() > 0 && $result[0]->thietHaiVeNguoi != 0 ? 'block' : 'none'}} ;" >
        <label for="textInput">Số người:</label>
        <input class="form-control" type="number" name="thietHaiVeNguoi" id="textInput" value="{{$result->count()>0?$result[0]->thietHaiVeNguoi:''}}"></input>
    </div>
</div>
<div class="form-group">
    <label for="description">Mô tả thiệt hại:</label>
    <textarea class="form-control" id="description" name="thietHaiVeTaiSan" rows="4" required>{{$result->count()>0?$result[0]->thietHaiVeTaiSan:''}}</textarea>
</div>
<div class="form-group">
    <label for="name">Ước tính tổng thiệt hại:</label>
    <input type="number" class="form-control" id="money" name="UocTinhTongThietHai" value="{{$result->count()>0?$result[0]->uocTinhTongThietHai:'0'}}" min="0" step="1000" required>
</div>
<div class="form-group">
    <label for="name">Mức độ thiệt hại dự kiến:</label>
    <select class="hanghoa-select form-control" data-search="true" name="idMucDoThietHai">
        @foreach($MucDos as $dll)
            <option  value="{{$dll->idMucDoThietHai}}" {{$result->count()>0?$result[0]->idMucDoThietHai==$dll->idMucDoThietHai?'selected':'':''}}>{{$dll->tenMucDo}}</option>
        @endforeach
    </select>
</div>
@if($result->count()>0)
    <div class="form-group">
        <label for="name">Trạng thái phê duyệt:</label>
        <input type="text" value="{{$result[0]->trangThaiPheDuyet}}" readonly></input>
    </div>
@endif
