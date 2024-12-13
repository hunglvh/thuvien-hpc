<?php
include('conncet.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $tk = $_POST['tk'];
    $mk = $_POST['mk'];
    $email = $_POST['email'];
    $sodienthoai = $_POST['sodienthoai'];
    $masv = $_POST['masv'];
    $role = $_POST['role'];

    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $target = "data/";
        $anh = $target . basename($_FILES["anh"]["name"]);
        move_uploaded_file($_FILES["anh"]["tmp_name"], $anh);

        // Câu lệnh SQL cập nhật có bao gồm ảnh
        $sql = "UPDATE nguoidung SET tk = '$tk', mk = '$mk', email = '$email', sodienthoai = '$sodienthoai', masv = '$masv', role = '$role', anh = '$anh' WHERE id = $id";
    }else{
        $sql = "UPDATE nguoidung SET tk = '$tk', mk = '$mk', email = '$email', sodienthoai = '$sodienthoai', masv = '$masv', role = '$role' WHERE id = $id";
    }


   
    
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
