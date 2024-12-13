<?php
include('conncet.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $tensach = $_POST['tensach'];
    $tacgia = $_POST['tacgia'];
    $theloai = $_POST['theloai'];
    $mota = $_POST['mota'];
    $soluong = $_POST['soluong'];
    // Xử lý upload ảnh
    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $target = "data/";
        $anh = $target . basename($_FILES["anh"]["name"]);
        move_uploaded_file($_FILES["anh"]["tmp_name"], $anh);

        // Câu lệnh SQL cập nhật có bao gồm ảnh
        $sql = "UPDATE sach SET tensach = '$tensach', tacgia = '$tacgia', theloai = '$theloai', mota = '$mota', soluong = $soluong, anh = '$anh' WHERE id = $id";
    }else{
        $sql = "UPDATE sach SET tensach = '$tensach', tacgia = '$tacgia', theloai = '$theloai', mota = '$mota', soluong = $soluong WHERE id = $id";
    }

    
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
