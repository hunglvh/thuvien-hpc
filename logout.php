<?php
session_start();

// Xóa tất cả biến phiên và hủy phiên
session_unset();
session_destroy();

// Ngăn trình duyệt lưu cache của trang
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Chuyển hướng về trang đăng nhập
header("Location: index.php");
exit();
if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    exit();
}


?>
