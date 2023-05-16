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
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <p>Số tiền</p>
        <input type="number" class="form-control" id="money" name="money[]" value="0" min="0" step="1000" required>
    </div>
    <hr/>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script>
    const btnAdds = document.querySelectorAll('.btn-add');

    btnAdds.forEach((btnAdd) => {
        const table = btnAdd.closest('.form-group').querySelector('table');

        btnAdd.addEventListener('click', () => {
            const rowCount = table.rows.length;
            const row = table.tBodies[0].insertRow(-1);
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);
            const cell3 = row.insertCell(2);
            const cell4 = row.insertCell(3);
            cell1.textContent = rowCount;
            cell2.innerHTML = `
                        <input type="hidden" name="sl[]" value="` + rowCount + `">
                        <select class="hanghoa-select form-control" data-search="true" name="idHangCuuTro[]">
                            @foreach($HangCT as $hct)
            <option value="{{$hct->idHangCuuTro}}">{{$hct->tenHangCuuTro}} - {{$hct->donViTinh}}</option>
                            @endforeach
            </select>`;
            cell3.innerHTML = '<input type="number" name="soluongDuKien[]" value="1" min="0">';
            cell4.innerHTML = '<button class="btn-remove btn btn-danger btn-sm" type="button">X</button>';
            cell4.querySelector('.btn-remove').addEventListener('click', removeRow);

            // Add event listener for new remove button
            const newBtnRemove = row.querySelector('.btn-remove');
            newBtnRemove.addEventListener('click', removeRow);

            // Initialize Select2 for the new row
            $(row).find('.hanghoa-select').select2();
        });
    });
    function removeRow() {
        const row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateRowCount();
    }

    function updateRowCount() {
        btnAdds.forEach((btnAdd) => {
            const table = btnAdd.closest('.form-group').querySelector('table');
            const rowCount = table.rows.length;
            for (let i = 1; i < rowCount; i++) {
                table.rows[i].cells[0].textContent = i;
            }
        });
    }
    $(document).ready(function() {
        $('.hanghoa-select').select2();
    });
</script>
