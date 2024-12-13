<?php
include('conncet.php');

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Cập nhật trạng thái thành 'da_tra'
    $sql = "UPDATE muonsach SET trangthai = 'da_tra' WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)) {
        echo "success";
    } else {
        echo "error";
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>