<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký Tài Khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .banner {
            background-color: #0077cc; /* Màu xanh nước biển */
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .form-dangky {
            display: flex;
            flex-direction: column;
        }

        .form-dangky label {
            margin-bottom: 5px;
        }

        .form-dangky input[type="text"],
        .form-dangky input[type="email"],
        .form-dangky input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #0077cc; /* Màu xanh nước biển */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #005fa3; /* Màu tối hơn khi hover */
        }

        /* Định dạng cho liên kết đăng nhập */
        .link-dangnhap {
            display: block;
            text-align: center; /* Căn giữa liên kết */
            margin-top: 10px; /* Khoảng cách trên */
            text-decoration: none; /* Bỏ gạch chân */
        }
    </style>
</head>
<body>

<div class="container">
    <header class="banner">
        <h1>Đăng Ký Tài Khoản Thư Viện</h1>
    </header>

    <form action="xuli_dangky.php" method="POST" class="form-dangky" enctype="multipart/form-data">
        <label for="tk">Tên tài khoản:</label>
        <input type="text" id="tk" name="tk" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mk">Mật khẩu:</label>
        <input type="password" id="mk" name="mk" required>

        <label for="masv">Mã sinh viên:</label>
        <input type="text" id="masv" name="masv">

        <label for="anh">Ảnh avatar:</label>
        <input type="file" id="anh" name="anh" accept="image/*" required>
        
        <label for="sodienthoai">Số điện thoại:</label>
        <input type="text" id="sodienthoai" name="sodienthoai" required>

        <input type="hidden" name="role" value="user">

        <button type="submit">Đăng Ký</button>
        <a href="dangnhap.php" class="link-dangnhap">
            <button type="button">Đăng Nhập</button>
        </a>
    </form>
</div>

</body>
</html>
