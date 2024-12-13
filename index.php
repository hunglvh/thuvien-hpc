<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện HPC</title>
    <link rel="stylesheet" href="index.css">
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

        <!-- Tìm kiếm -->
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" class="search-box" placeholder="Tìm kiếm sách hoặc tên tác giả ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Tìm kiếm</button>
            </form>
            
            <?php 
            try {
                include('conncet.php');
                
                if (!$conn) {
                    die("Không thể kết nối đến cơ sở dữ liệu");
                }

                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
                
                if ($search) {
                    $query = "SELECT * FROM sach WHERE tensach LIKE ? OR tacgia LIKE ? LIMIT 50";
                    $stmt = mysqli_prepare($conn, $query);
                    $searchParam = "%{$search}%";
                    mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                } else {
                    $query = "SELECT * FROM sach LIMIT 50";
                    $result = mysqli_query($conn, $query);
                }
            } catch (Exception $e) {
                die("Đã xảy ra lỗi: " . $e->getMessage());
            }
            ?>
        </div>

        <div class="auth-buttons">
            <button onclick="window.location.href='dangnhap.php'">Đăng nhập</button>
            <button onclick="window.location.href='dangky.php'">Đăng ký</button>
        </div>
    </div>

    <!-- Menu chính -->
    <div class="menu">
        <button onclick="window.location.href='index.php'">Trang chủ</button>
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
        <button>Lịch sử mượn sách</button>
        <button>Nạp tiền </button>
    </div>

    <!-- Khu vực hiển thị sách -->
    <div class="book-section">
        <?php 
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="book-card">
            <img src="<?php echo $row['anh']; ?>" alt="Ảnh sách">
            <h3><?php echo $row['tensach']; ?></h3>
            <button class="view-details-btn" onclick="showBookDetails('<?php echo addslashes($row['tensach']); ?>', '<?php echo addslashes($row['tacgia']); ?>', '<?php echo addslashes($row['mota']); ?>', '<?php echo addslashes($row['soluong']); ?>', '<?php echo $row['anh']; ?>')">
                Xem chi tiết
            </button>
        </div>
        <?php 
            }
            mysqli_close($conn);
        ?>
    </div>

    <div class="modal" id="bookDetailsModal" style="display: none;">
        <img id="bookAnh" alt="Ảnh sách">
        <div class="modal-content">
            <h3 id="bookTensach"></h3>
            <p><strong>Tác giả:</strong> <span id="bookTacgia"></span></p>
            <p><strong>Số lượng:</strong> <span id="bookSoluong"></span></p>
            <div class="mota" id="bookMota"></div>
            
            <button onclick="window.location.href='dangnhap.php'" class="rent-btn">bạn chưa có tài khoản hãy đăng nhập</button>
            <button class="close-btn" onclick="closeBookDetails()">Đóng</button>
        </div>
    </div>

    <div class="footer">
    <p>Địa chỉ:km3 + 350 ,Đ.Phan Trọng Tuê ,Tam hiệp ,Thanh Trì Hà nội</p>
    <p>Điện thoại: 0332209386</p>
    <p>Email: hung240304@gmail.com.com</p>
    </div>

    <script>
        let currentBanner = 0;
        const banners = document.querySelectorAll('.banner');

        setInterval(() => {
            banners[currentBanner].classList.remove('active');
            currentBanner = (currentBanner + 1) % banners.length;
            banners[currentBanner].classList.add('active');
        }, 3000);

        // Hàm hiển thị chi tiết sách
        function showBookDetails(tensach, tacgia, mota, soluong, anh) {
            document.getElementById('bookTensach').innerText = tensach;
            document.getElementById('bookTacgia').innerText = tacgia;
            document.getElementById('bookSoluong').innerText = soluong;
            document.getElementById('bookMota').innerText = mota;
            document.getElementById('bookAnh').src = anh;
            document.getElementById('bookDetailsModal').style.display = 'flex';
        }

        // Hàm đóng modal
        function closeBookDetails() {
            document.getElementById('bookDetailsModal').style.display = 'none';
        }
    </script>
</body>
</html>
