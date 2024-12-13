<?php
session_start();
include('conncet.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['masv'])) {
    header('Location: dangnhap.php');
    exit();
}

$masv = $_SESSION['masv'];

// Lấy lịch sử mượn sách của user
$sql = "SELECT m.*, s.tensach, s.anh 
        FROM muonsach m 
        JOIN sach s ON m.tensach = s.tensach 
        WHERE m.masv = ? 
        ORDER BY m.ngaymuon DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $masv);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mượn sách - Thư viện HPC</title>
    <link rel="stylesheet" href="trangforuser.css">
    <style>
        .history-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .history-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .book-image {
            width: 100px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 4px;
        }
        .book-details {
            flex: 1;
        }
        .book-details h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .book-details p {
            margin: 5px 0;
            color: #666;
        }
        .status {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-top: 5px;
        }
        .status-active {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        .status-returned {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .status-overdue {
            background-color: #ffebee;
            color: #c62828;
        }
        .no-history {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header-top">
        <div class="logo">
            <img src="anh1/logo-truong-1.png" alt="logo">
        </div>
    </div>

    <div class="menu">
        <button onclick="window.location.href='trangforuser.php'">Trang chủ</button>
        <button onclick="window.location.href='logout.php'">Đăng xuất</button>
    </div>

    <div class="history-container">
        <h2>Lịch sử mượn sách</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="history-item">
                    <img src="<?php echo htmlspecialchars($row['anh']); ?>" alt="<?php echo htmlspecialchars($row['tensach']); ?>" class="book-image">
                    <div class="book-details">
                        <h3><?php echo htmlspecialchars($row['tensach']); ?></h3>
                        <p>Mã sinh viên: <?php echo htmlspecialchars($row['masv']); ?></p>
                        <p>Ngày mượn: <?php echo date('d/m/Y', strtotime($row['ngaymuon'])); ?></p>
                        <p>Ngày trả: <?php echo date('d/m/Y', strtotime($row['ngaytra'])); ?></p>
                        <?php
                        $today = new DateTime();
                        $returnDate = new DateTime($row['ngaytra']);
                        $status = '';
                        
                        if ($row['trangthai'] == 'Đã trả') {
                            $status = '<span class="status status-returned">Đã trả</span>';
                        } elseif ($today > $returnDate) {
                            $status = '<span class="status status-overdue">Quá hạn</span>';
                        } else {
                            $status = '<span class="status status-active">Đang mượn</span>';
                        }
                        ?>
                        <p>Trạng thái: <?php echo $status; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-history">Bạn chưa mượn sách nào.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        <p>Địa chỉ: Số 123, Đường ABC, Quận 1, TP. HCM</p>
        <p>Điện thoại: 0123 456 789</p>
        <p>Email: lienhe@thuviendientu.com</p>
    </div>
</body>
</html>
