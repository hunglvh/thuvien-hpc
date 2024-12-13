<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e3f2fd; 
            color: #0d47a1;
            margin: 0; 
            padding: 20px; 
        }
        
        h2 {
            text-align: center; 
            color: #1e88e5;
        }

        form {
            background-color: #ffffff;
            border: 1px solid #1e88e5;
            border-radius: 8px; 
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 20px; 
            max-width: 400px;
            margin: 20px auto; 
        }

        label {
            display: block; 
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc;
            border-radius: 4px; 
            font-size: 16px; 
        }

        button {
            margin: 10px 0;
            background-color: #1e88e5; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 4px; 
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        /* Hiệu ứng hover cho nút gửi */
        button:hover {
            background-color: #1565c0; /* Màu nền khi di chuột vào */
        }

        /* Định dạng cho liên kết đăng ký */
        .link-dangky {
            display: block;
            text-align: center; /* Căn giữa liên kết */
            margin-top: 10px; /* Khoảng cách trên */
            text-decoration: none; /* Bỏ gạch chân */
            font-size: 16px;
            color: white; /* Màu chữ cho liên kết giống nút */
            background-color: #1e88e5; /* Màu nền giống nút */
            padding: 10px; /* Khoảng cách bên trong */
            border-radius: 4px; /* Bo tròn góc */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu */
        }

        /* Hiệu ứng hover cho liên kết đăng ký */
        .link-dangky:hover {
            background-color: #1565c0; /* Màu nền khi di chuột vào */
        }
    </style>
    <script>
        function validateForm() {
            var tk = document.getElementById("tk").value;
            var mk = document.getElementById("mk").value;
            if (empty(tk) || empty(mk)) {
                alert("Vui lòng nhập tên đăng nhập và mật khẩu.");
                return false; // Ngăn không cho gửi form
            }
            return true; // Cho phép gửi form
        }
    </script>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <form action="xuli_dangnhap.php" method="POST" onsubmit="return validateForm();"  enctype="multipart/form-data">
        <label for="tk">Tên đăng nhập:</label>
        <input type="text" id="tk" name="tk" required>

        <label for="mk">Mật khẩu:</label>
        <input type="password" id="mk" name="mk" required>

        <label for="role">Vai trò:</label>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="nhanvien">Nhân viên</option>
        </select>

        <button type="submit">Đăng Nhập</button>
        <a href="dangki.php" class="link-dangky">Đăng Ký</a>
    </form>
</body>
</html>
