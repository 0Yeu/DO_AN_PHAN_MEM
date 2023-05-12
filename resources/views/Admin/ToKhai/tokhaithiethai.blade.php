<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @include('Admin.head');
    <!-- Tải Select2 từ CDN -->
    <title>Tờ khai thiệt hại</title>
    <style type="text/css">
        .select2-selection__rendered{
            padding: 0;
        }
        select{
            padding: 0!important;
        }
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Đăng ký ủng hộ</h1>
<form>
    <div class="form-group">
        <label for="name">Tên người đăng ký:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="description">Mô tả thiệt hại:</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
    </div>

    <div class="form-group">
        <label for="value">Giá trị thiệt hại:</label>
        <table class="table table-striped table-valign-middle">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên hàng hóa</th>
                <th>Số lượng</th>
                <th><button type="button" class="btn btn-success btn-sm btn-add">+</button></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="form-group">
        <label for="date">Ngày xảy ra:</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <button type="submit" class="btn btn-primary">Gửi tờ khai</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script>
    const table = document.querySelector('table');
    const btnAdd = document.querySelector('.btn-add');

    btnAdd.addEventListener('click', () => {
        const rowCount = table.rows.length;
        const row = table.tBodies[0].insertRow(-1);
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        cell1.textContent = rowCount;
        cell2.innerHTML = `
      <select class="hanghoa-select form-control" data-search="true">
        <option value="">Chọn hàng hóa</option>
        <option value="item1">Hàng hóa 1</option>
        <option value="item2">Hàng hóa 2</option>
        <option value="item3">Hàng hóa 3</option>
        <option value="item4">Hàng hóa 4</option>
        <option value="item5">Hàng hóa 5</option>
      </select>`;
        cell3.innerHTML = '<input type="text">';
        cell4.innerHTML = '<button class="btn-remove" type="button">-</button>';
        cell4.querySelector('.btn-remove').addEventListener('click', removeRow);

        // Add event listener for new remove button
        const newBtnRemove = row.querySelector('.btn-remove');
        newBtnRemove.addEventListener('click', removeRow);
        $(document).ready(function() {
            $('.hanghoa-select').select2();
        });
    });

    function removeRow() {
        const row = this.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateRowCount();
    }

    function updateRowCount() {
        const rowCount = table.rows.length;
        for (let i = 1; i < rowCount; i++) {
            table.rows[i].cells[0].textContent = i;
        }
    }
</script>
</body>
</html>
