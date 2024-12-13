<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển Quản Trị</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="admin1.css">
</head>

<body>

    <header class="banner">
        <h1>Bảng Điều Khiển Quản Trị</h1>
        <p>Quản lý người dùng, quản trị viên và sách dễ dàng</p>
    </header>

    <main class="admin-container">
        <div class="admin-option" onclick="toggleUserManagement()">
            <i class="fas fa-user"></i>
            <span>Quản Lý Người Dùng</span>
        </div>
        <div class="admin-option" onclick="toggleBorrowManagement()">
            <i class="fas fa-book-reader"></i>
            <span>Quản Lý Mượn Sách</span>
        </div>
        <div class="admin-option" onclick="toggleBookManagement()">
            <i class="fas fa-book"></i>
            <span>Quản Lý Sách</span>
        </div>
        <div class="admin-option" onclick="window.location.href='index.php'">
            <i class="fas fa-users"></i>
            <span>Trang cho Người Dùng</span>
        </div>
    </main>

    <!-- Quản lý người dùng -->
    <div id="userManagement" class="user-management" style="display: none;">
        <table class="user-list">
            <h2>
                <center>Danh sách người dùng</center>
            </h2>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tài Khoản</th>
                    <th>Mật Khẩu</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Mã Sinh Viên</th>
                    <th>Quyền</th>
                    <th>Ảnh</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('conncet.php');
                $sql = "SELECT * FROM nguoidung";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['mk']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sodienthoai']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['masv']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td><img src='http://localhost:8080/thuvienhpc/" . htmlspecialchars($row['anh']) . "' alt='Ảnh người dùng' width='50' height='50'></td>";
                        echo "<td>
                                <button onclick='openEditModal(" . $row['id'] . ")'>Sửa</button>
                                <button onclick='confirmDeleteUser(" . $row['id'] . ")'>Xóa</button>
                             </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn" type="button" onclick="window.location.href='dangki.php'">Thêm người dùng</button>
    </div>

    <!-- Quản lý sách -->
    <div id="bookManagement" class="book-management" style="display: none;">
        <table class="book-list">
            <h2>
                <center>Danh sách sách</center>
            </h2>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Thể Loại</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th>Số Lượng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM sach";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tensach']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tacgia']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['theloai']) . "</td>";
                        echo "<td><img src='http://localhost:8080/thuvienhpc/" . htmlspecialchars($row['anh']) . "' alt='Ảnh sách' width='50' height='50'></td>";
                        echo "<td>" . htmlspecialchars($row['mota']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['soluong']) . "</td>";
                        echo "<td>
                                <button onclick='openEditBookModal(" . $row['id'] . ")'>Sửa</button>
                                <button onclick='confirmDeleteSach(" . $row['id'] . ")'>Xóa</button>
                             </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <button class="btn" type="button" onclick="window.location.href='themsach.php'">Thêm sách</button>
    </div>

    <!-- Quản lý mượn sách -->
    <div id="borrowManagement" class="borrow-management" style="display: none;">
        <table class="borrow-list">
            <h2>
                <center>Danh sách mượn sách</center>
            </h2>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Tên sách</th>
                    <th>Ngày mượn</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT m.*, n.tk as tennguoidung 
                        FROM muonsach m 
                        JOIN nguoidung n ON m.masv = n.masv 
                        ORDER BY m.ngaymuon DESC";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $today = new DateTime();
                        $ngaytra = new DateTime($row['ngaytra']);
                        $status_class = '';
                        $display_status = '';

                        if ($row['trangthai'] == 'da_tra') {
                            $status_class = 'status-returned';
                            $display_status = 'Đã trả';
                        } elseif ($today > $ngaytra && $row['trangthai'] == 'dang_muon') {
                            $status_class = 'status-overdue';
                            $display_status = 'Đang mượn (Quá hạn)';
                        } else {
                            $status_class = 'status-borrowed';
                            $display_status = 'Đang mượn';
                        }

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['masv']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tennguoidung']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tensach']) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['ngaymuon'])) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['ngaytra'])) . "</td>";
                        echo "<td class='" . $status_class . "'>" . $display_status . "</td>";
                        echo "<td>";
                        if ($row['trangthai'] != 'da_tra') {
                            echo "<button onclick='confirmReturn(" . $row['id'] . ")'>Xác nhận trả</button>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Không có dữ liệu mượn sách.</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal sửa người dùng -->
    <div id="EditModal" class="modal">
        <div class="modal-content">
            <h2>Sửa thông tin người dùng</h2>
            <form id="editForm">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label>Tài khoản:</label>
                    <input type="text" id="editTk" name="tk" required>
                </div>
                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" id="editMk" name="mk">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" id="editEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input type="text" id="editSdt" name="sodienthoai">
                </div>
                <div class="form-group">
                    <label>Mã sinh viên:</label>
                    <input type="text" id="editMasv" name="masv">
                </div>
                <div class="form-group">
                    <label>Ảnh avatar:</label>
                    <input type="file" id="anh" name="anh" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Quyền:</label>
                    <select id="editRole" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="button" onclick="saveUserChanges()">Lưu</button>
                <button type="button" onclick="closeEditModal()">Đóng</button>
            </form>
        </div>
    </div>

    <!-- Modal sửa sách -->
    <div id="editBookModal" class="modal">
        <div class="modal-content">
            <h2>Sửa thông tin sách</h2>
            <form id="editBookForm">
                <input type="hidden" id="editBookId" name="id">
                <div class="form-group">
                    <label>Tên sách:</label>
                    <input type="text" id="editTensach" name="tensach" required>
                </div>
                <div class="form-group">
                    <label>Ảnh sách:</label>
                    <input type="file" id="anh" name="anh" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Tác giả:</label>
                    <input type="text" id="editTacgia" name="tacgia" required>
                </div>
                <div class="form-group">
                    <label>Thể loại:</label>
                    <input type="text" id="editTheloai" name="theloai" required>
                </div>
                <div class="form-group">
                    <label>Mô tả:</label>
                    <textarea id="editMota" name="mota"></textarea>
                </div>
                <div class="form-group">
                    <label>Số lượng:</label>
                    <input type="number" id="editSoluong" name="soluong" required>
                </div>
                <button type="button" onclick="saveBookChanges()">Lưu</button>
                <button type="button" onclick="closeEditBookModal()">Đóng</button>
            </form>
        </div>
    </div>
        
    <script src="admin.js"></script>
</body>

</html>