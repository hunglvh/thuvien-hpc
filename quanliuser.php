<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
</head>
<body>

<h2>Danh sách người dùng</h2>

<table border="1">  
    <tr>
        <th>ID</th>
        <th>tài khoản</th>
        <th>mật khẩu</th>
        <th>email</th>
        <th>số điện thoại</th>
        <th>mã sinh viên </th>
        <th>ảnh</th>
        <th>quyền</th>
    </tr> 

                <?php
include('conncet.php'); // Kết nối với cơ sở dữ liệu

$sql = "SELECT * FROM nguoidung"; // Câu truy vấn để lấy tất cả người dùng
$result = mysqli_query($conn, $sql);

// Kiểm tra xem có bản ghi nào không
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['tk']; ?></td>
            <td><?php echo $row['mk']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['sodienthoai']; ?></td>
            <td><?php echo $row['masv']; ?></td>
            <td><img src="http://localhost:8080/thuvienHPC/<?php echo $row['anh'];?>"/></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="http://localhost:8080/ungdungbanhang/sua-user.php?id=<?php echo $row['id']; ?>">Sửa</a> |
                <a href="http://localhost:8080/ungdungbanhang/xoa-user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">Xóa</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='10'>Không có dữ liệu người dùng.</td></tr>";
}

mysqli_close($conn); // Đóng kết nối
?>

</table>

<button type="button" onclick="window.location.href='http://localhost:8080/ungdungbanhang/themsp.php'">thêm người dùng </button>
</body>
</html>
