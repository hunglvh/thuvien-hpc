
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
// Kết nối đến database
include 'conncet.php';

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $tk = $_POST['tk'];
    $email = $_POST['email'];
    $mk = password_hash($_POST['mk'], algo: PASSWORD_DEFAULT); // Mã hóa mật khẩu
    $masv = $_POST['masv'];
    // $manv = $_POST['manv'];
    $target="data/";
    $anh=$target . basename($_FILES["anh"]["name"]);
    move_uploaded_file($_FILES["anh"]["tmp_name"],$anh);
    $sodienthoai = $_POST['sodienthoai'];
    $role = $_POST['role'];

    // Câu truy vấn để thêm người dùng vào bảng nguoidung
    $sql = "INSERT INTO nguoidung (tk, email, mk, masv,anh, sodienthoai,role)
            VALUES ('$tk','$email','$mk','$masv','$anh','$sodienthoai','$role')";
    if (mysqli_query($conn, $sql)) {
        echo "Đăng ký thành công!";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối đến database
mysqli_close($conn);

?>
<button type="button" onclick="window.location.href='http://localhost:8080/thuvienHPC/dangnhap.php'">Quay Lại trang đăng nhập</button>
</body>
</html>
