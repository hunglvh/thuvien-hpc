<?php
include('conncet.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM sach WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);
}
?>
