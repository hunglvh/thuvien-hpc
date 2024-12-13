<?php
include('conncet.php'); // Kết nối với database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $tensach = $_POST['tensach'];
    $tacgia = $_POST['tacgia'];
    $theloai = $_POST['theloai'];
    $soluong = $_POST['soluong'];
    $target="data/";
    // Xử lý hình ảnh
    $anh=$target . basename($_FILES["anh"]["name"]);
    move_uploaded_file($_FILES["anh"]["tmp_name"],$anh); 

    $mota=$_POST['mota'];
    // Câu lệnh SQL để thêm sách vào bảng sách
    $sql = "INSERT INTO sach (tensach, tacgia, theloai, soluong, anh,mota) VALUES ('$tensach','$tacgia','$theloai','$soluong','$anh','$mota')";
    
    // Chuẩn bị và thực thi câu lệnh
    mysqli_query($conn,$sql);
    $conn->close();
}
?>
