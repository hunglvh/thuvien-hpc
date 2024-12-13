<?php
session_start();
include('conncet.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['id'])) {
    header('Location: dangnhap.php');
    exit();
}

// Lấy thông tin user từ database
$id = $_SESSION['id'];
$sql = "SELECT * FROM nguoidung WHERE id = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Cập nhật session với dữ liệu mới
$_SESSION['tk'] = $user['tk'];
$_SESSION['masv'] = $user['masv'];
$_SESSION['email'] = $user['email'];
$_SESSION['sodienthoai'] = $user['sodienthoai'];
$_SESSION['anh'] = $user['anh'];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện HPC</title>
    <link rel="stylesheet" href="trangforuser.css">
</head>

<body>
    <div class="banner-container">
        <img src="anh1/banner1.jpg" class="banner active" alt="Banner 1">
        <img src="anh1/banner2.png" class="banner" alt="Banner 2">
        <img src="anh1/banner3.jpg" class="banner" alt="Banner 3">
    </div>

    <div class="header-top">
        <div class="logo">
            <img src="anh1/logo-truong-1.png" alt="logo">
        </div>

        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" class="search-box"
                    placeholder="Tìm kiếm sách hoặc tên tác giả..."
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <!-- Phần hiển thị thông tin user -->
    <div class="user-info-section">
        <div class="user-profile">
            <div class="profile-image">
                <?php if (!empty($user['anh'])): ?>
                    <img src="<?php echo htmlspecialchars($user['anh']); ?>" alt="Avatar">
                <?php else: ?>
                    <img src="anh1/default-avatar.jpg" alt="Default Avatar">
                <?php endif; ?>
            </div>
            <div class="profile-details">
                <h2>Thông tin cá nhân</h2>
                <div class="info-item">
                    <label>Tên tài khoản:</label>
                    <span><?php echo htmlspecialchars($user['tk']); ?></span>
                </div>
                <div class="info-item">
                    <label>Mã sinh viên:</label>
                    <span><?php echo htmlspecialchars($user['masv']); ?></span>
                </div>
                <div class="info-item">
                    <label>Email:</label>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
                <div class="info-item">
                    <label>Số điện thoại:</label>
                    <span><?php echo htmlspecialchars($user['sodienthoai']); ?></span>
                </div>
            </div>
        </div>
    </div>
        <!-- menu lựa chọn dưới phần hiển thị thông tin -->


        <div class="menu">
            <button onclick="window.location.href='trangforuser.php'">Trang chủ</button>
            <div class="dropdown">
                <button>Thể loại sách</button>
                <div class="dropdown-content">
                    <a href="?theloai=khoa học">Khoa học</a>
                    <a href="?theloai=văn học">Văn học</a>
                    <a href="?theloai=lịch sử">Lịch sử</a>
                    <a href="?theloai=kinh tế">Kinh tế</a>
                    <a href="?theloai=công nghệ">Công nghệ</a>
                </div>
            </div>
            <button onclick="window.location.href='lichsumuon.php'">Lịch sử mượn sách</button>
            <button>Nạp tiền cọc</button>
            <button onclick="window.location.href='logout.php'">Đăng xuất</button>
        </div>

        <!-- Khu vực hiển thị sách -->
        <div class="book-section">
            <?php
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
            $theloai = isset($_GET['theloai']) ? mysqli_real_escape_string($conn, $_GET['theloai']) : '';

            $query = "SELECT * FROM sach WHERE 1=1";
            if ($search) {
                $query .= " AND (tensach LIKE '%$search%' OR tacgia LIKE '%$search%')";
            }
            if ($theloai) {
                $query .= " AND theloai = '$theloai'";
            }
            $query .= " LIMIT 9"; // Giới hạn 9 cuốn sách (3x3)

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="book-card" onclick="showBookDetails(
            '<?php echo addslashes($row['tensach']); ?>', 
            '<?php echo addslashes($row['tacgia']); ?>', 
            '<?php echo addslashes($row['mota']); ?>', 
            '<?php echo addslashes($row['soluong']); ?>', 
            '<?php echo $row['anh']; ?>'
        )">
                    <img src="<?php echo $row['anh']; ?>" alt="Ảnh sách">
                    <h3><?php echo $row['tensach']; ?></h3>
                </div>
            <?php
            }
            mysqli_close($conn);
            ?>
        </div>

        <!-- Modal chi tiết sách -->
        <div class="modal" id="bookDetailsModal">
            <div class="modal-content">
                <img id="bookAnh" src="" alt="Ảnh sách">
                <h3 id="bookTensach"></h3>
                <p><strong>Tác giả:</strong> <span id="bookTacgia"></span></p>
                <p><strong>Số lượng:</strong> <span id="bookSoluong"></span></p>
                <div class="mota" id="bookMota"></div>

                <form id="rentBookForm" method="POST" action="process_rent.php">
                    <input type="hidden" id="bookId" name="tensach">
                    <div class="form-group">
                        <label>Ngày mượn:</label>
                        <input type="date" name="ngaymuon" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ngày trả:</label>
                        <input type="date" name="ngaytra"
                            min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
                            value="<?php echo date('Y-m-d', strtotime('+7 day')); ?>" required>
                    </div>
                    <button type="submit" class="rent-btn">Mượn sách</button>
                </form>

                <button class="close-btn" onclick="closeBookDetails()">Đóng</button>
            </div>
        </div>

        <div class="footer">
            <p>Địa chỉ:km3 + 350 ,Đ.Phan Trọng Tuê ,Tam hiệp ,Thanh Trì Hà nội</p>
            <p>Điện thoại: 0332209386</p>
            <p>Email: hung240304@gmail.com.com</p>
        </div>

        <script>
            // Banner rotation
            let currentBanner = 0;
            const banners = document.querySelectorAll('.banner');

            setInterval(() => {
                banners[currentBanner].classList.remove('active');
                currentBanner = (currentBanner + 1) % banners.length;
                banners[currentBanner].classList.add('active');
            }, 3000);

            // Book details modal
            function showBookDetails(tensach, tacgia, mota, soluong, anh) {
                document.getElementById('bookTensach').innerText = tensach;
                document.getElementById('bookTacgia').innerText = tacgia;
                document.getElementById('bookSoluong').innerText = soluong;
                document.getElementById('bookMota').innerText = mota;
                document.getElementById('bookAnh').src = anh;
                document.getElementById('bookId').value = tensach;
                document.getElementById('bookDetailsModal').style.display = 'flex';
            }

            function closeBookDetails() {
                document.getElementById('bookDetailsModal').style.display = 'none';
            }

            // Rent book form handling
            document.getElementById('rentBookForm').addEventListener('submit', function(e) {
                e.preventDefault();

                fetch('process_rent.php', {
                        method: 'POST',
                        body: new FormData(this)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                            closeBookDetails();
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        alert('Đã xảy ra lỗi khi xử lý yêu cầu');
                    });
            });
        </script>
</body>

</html>