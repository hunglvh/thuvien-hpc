<?php 
    $severname="localhost";
    $database="thuvienHPC";
    $username="root";
    $password="";
    $conn=mysqli_connect($severname,$username,$password,$database);
    if(!$conn){
        die("lỗi kết nối" . mysqli_connect_error());
    }
?>
