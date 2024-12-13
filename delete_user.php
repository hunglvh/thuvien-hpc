<?php 
    include('conncet.php');
    $id=$_GET['id'];
    $sql="DELETE FROM nguoidung where id=$id";
    if (mysqli_query($conn,$sql)){
        echo "người dùng đã được xóa";
    }
    mysqli_close($conn);
    ?>