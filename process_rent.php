<?php
session_start();
include('conncet.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tensach = mysqli_real_escape_string($conn, $_POST['tensach']);
    $masv = $_SESSION['masv'];
    $ngaymuon = $_POST['ngaymuon'];
    $ngaytra = $_POST['ngaytra'];
    $trangthai = "Đang mượn";

    // Kiểm tra số lượng sách còn
    $check_sql = "SELECT soluong FROM sach WHERE tensach = '$tensach'";
    $check_result = mysqli_query($conn, $check_sql);
    $book = mysqli_fetch_assoc($check_result);

    if ($book['soluong'] > 0) {
        // Thêm vào bảng muonsach
        $sql = "INSERT INTO muonsach (masv, tensach, ngaymuon, ngaytra, trangthai) 
                VALUES ('$masv', '$tensach', '$ngaymuon', '$ngaytra', '$trangthai')";
        
        if (mysqli_query($conn, $sql)) {
            // Cập nhật số lượng sách
            $update_sql = "UPDATE sach SET soluong = soluong - 1 WHERE tensach = '$tensach'";
            mysqli_query($conn, $update_sql);
            
            echo json_encode(['status' => 'success', 'message' => 'Đăng ký mượn sách thành công!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi đăng ký mượn sách']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sách đã hết!']);
    }
    exit();
}
?> 