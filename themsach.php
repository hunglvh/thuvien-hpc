<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách</title>
    <style>
        /* Cài đặt chung */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

/* Container chứa form */
.form-container {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

/* Tiêu đề */
h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Các label */
label {
    text-align: left;
    font-size: 14px;
    color: #555;
    display: block;
    margin-top: 15px;
}

/* Các input và select */
input[type="text"],
input[type="number"],
select,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: all 0.3s ease-in-out;
}

/* Thay đổi border khi focus vào input */
input[type="text"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 204, 0, 0.3);
}

/* Button */
.submit-btn {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

/* Hiệu ứng hover cho nút */
.submit-btn:hover {
    background-color:black;
}

/* Hiệu ứng khi tải hình ảnh */
input[type="file"]:hover {
    border-color: #4CAF50;
}

/* Responsive */
@media (max-width: 600px) {
    .form-container {
        width: 90%;
    }
}

    </style>

</head>
<body>
    <div class="form-container">
        <h1>Thêm Sách Vào Thư Viện</h1>
        <form action="xuli-themsach.php" method="POST" enctype="multipart/form-data" class="book-form">
            <label for="tensach">Tên Sách:</label>
            <input type="text" id="tensach" name="tensach" placeholder="Nhập tên sách" required>

            <label for="tacgia">Tên Tác Giả:</label>
            <input type="text" id="tacgia" name="tacgia" placeholder="Nhập tên tác giả" required>

            <label for="theloai">Thể Loại:</label>
            <select id="theloai" name="theloai" required>
                <option value="">Chọn thể loại</option>
                <option value="Khoa học">Khoa học</option>
                <option value="Văn học">Văn học</option>
                <option value="Lịch sử">Lịch sử</option>
                <option value="Kinh tế">Kinh tế</option>
                <option value="Công nghệ">Công nghệ</option>
            </select>
            <label for="soluong">Số Lượng:</label>
            <input type="number" id="soluong" name="soluong" placeholder="Nhập số lượng sách" required>

            <label for="anh">Hình Ảnh Bìa Sách:</label>
            <input type="file" id="anh" name="anh" accept="image/*">
            
            <label for="mota">Mô tả :</label>
            <input type="text" id="mota" name="mota" required>

            <button type="submit" class="submit-btn">Thêm Sách</button>
        </form>
    </div>
</body>
</html>
