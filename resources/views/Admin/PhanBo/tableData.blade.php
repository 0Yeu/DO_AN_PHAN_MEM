@foreach($ListMucDo as $lmd)
    <div class="form-group" >
        <label for="idMucDoThietHai">{{$lmd->tenMucDo}}</label>
        <input type="hidden" class="form-control" id="idMucDoThietHai" name="idMucDoThietHai[]" value="{{ $lmd->idMucDoThietHai}}" required>
    </div>
    <div class="form-group">
        <table class="table table-striped table-valign-middle">
            <thead>
            <tr>
                <th>STT</th>
                <th style="width: 400px;">Tên hàng hóa</th>
                <th>Số lượng</th>
                <th><button type="button" class="btn btn-success btn-sm btn-add">+</button></th>
            </tr>
            </thead>
            <tbody>
            @if($result->count()>0)
                {{$i=0}}
                @foreach($result as $r)
                    @if($r->idMucDoThietHai==$lmd->idMucDoThietHai)
                        <tr>
                            <td>
                                {{++$i}}</td>
                            <td>
                                <input type="hidden" name="sl[]" value="{{$i}}">
                                <select class="hanghoa-select form-control" data-search="true" name="idHangCuuTro[]">
                                    @foreach($HangCT as $hct)
                                        <option value="{{$hct->idHangCuuTro}}" {{$hct->idHangCuuTro==$r->idHangCuuTro?'selected':''}}>{{$hct->tenHangCuuTro}} - {{$hct->donViTinh}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="soluongDuKien[]" value="{{$r->soLuongDuKien}}" min="0">
                            </td>
                            <td><button class="btn-remove btn btn-danger btn-sm" type="button" >X</button></td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <p>Số tiền</p>
        @if($result1->count()>0)
            @foreach($result1 as $r)
                @if($r->idMucDoThietHai==$lmd->idMucDoThietHai)
                    <input type="number" class="form-control" id="money" name="money[]" value="{{$r->tienDuKien}}" min="0" step="1000" required>
                @endif
            @endforeach
        @else
            <input type="number" class="form-control" id="money" name="money[]" value="0" min="0" step="1000" required>
        @endif
    </div>
    <hr/>
@endforeach
