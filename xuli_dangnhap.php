<?php 
session_start();
include('conncet.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tk = $_POST['tk'];
    $mk = $_POST['mk'];
    $message = 'validateForm()';

    if (empty($tk) || empty($mk)) {
        $message = "Vui lòng nhập tên đăng nhập và mật khẩu.";
    } else {
        // Truy vấn để lấy dữ liệu người dùng dựa trên tên đăng nhập
        $query = "SELECT * FROM nguoidung WHERE tk = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $tk);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            // So sánh mật khẩu đã nhập với mật khẩu đã mã hóa trong cơ sở dữ liệu
            if (password_verify($mk, $row['mk'])) {
                // Gán session cho người dùng đã đăng nhập thành công
                $_SESSION['id'] = $row['id'];
                $_SESSION['tk'] = $row['tk'];
                $_SESSION['masv'] = $row['masv'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['sodienthoai'] = $row['sodienthoai'];
                $_SESSION['anh'] = $row['anh'];

                // Kiểm tra vai trò và chuyển hướng phù hợp
                if ($row['role'] === 'admin') {
                    header("Location: admin.php");
                    exit();
                } elseif ($row['role'] === 'user') {
                    header("Location: trangforuser.php");
                    exit();
                } elseif ($row['role'] === 'nhanvien') {
                    header("Location: trangnhanvien.php");
                    exit();
                }
            } else {
                echo "Tài khoản hoặc mật khẩu không đúng. Nếu chưa có, hãy đăng ký.";
            }
        } else {
            echo "Tài khoản không tồn tại. Nếu chưa có, hãy đăng ký.";
        }
    }
}
?>
