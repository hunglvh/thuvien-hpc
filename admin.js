function toggleBorrowManagement() {
  document.getElementById("userManagement").style.display = "none";
  document.getElementById("bookManagement").style.display = "none";
  document.getElementById("borrowManagement").style.display = "block";
}
function confirmReturn(id) {
  if(confirm('Bạn có chắc chắn muốn xác nhận trả sách này?')) {
      $.ajax({
          url: 'process_return.php',
          type: 'POST',
          data: { id: id },
          success: function(response) {
              if(response === 'success') {
                  alert('Đã xác nhận trả sách thành công!');
                  // Reload trang để cập nhật danh sách
                  location.reload();
              } else {
                  alert('Có lỗi xảy ra!');
              }
          }
      });
  }
}
  // bảng quản lí người dùng
  function toggleUserManagement() {
    var userList = document.querySelector(".user-list");
    var userManagement = document.getElementById("userManagement");
    if (
      userManagement.style.display === "none" ||
      userManagement.style.display === ""
    ) {
      userManagement.style.display = "block";
      userList.style.display = "table";
    } else {
      userManagement.style.display = "none";
      userList.style.display = "none";
    }
  }
  
  // Mở bảng quản lý sách
  function toggleBookManagement() {
    var bookList = document.querySelector(".book-list");
    var bookManagement = document.getElementById("bookManagement");
    if (
      bookManagement.style.display === "none" ||
      bookManagement.style.display === ""
    ) {
      bookManagement.style.display = "block";
      bookList.style.display = "table";
    } else {
      bookManagement.style.display = "none";
      bookList.style.display = "none";
    }
  }

// Sửa thông tin người dùng (AJAX)
function saveUserChanges() {
  var formData = new FormData(document.getElementById("editForm"));
  $.ajax({
      url: 'update_user.php', // Tạo file PHP để xử lý dữ liệu
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          if(response == 'success') {
              alert("Cập nhật thông tin người dùng thành công!");
              location.reload(); // Reload trang sau khi cập nhật
          } else {
              alert("Đã có lỗi xảy ra, vui lòng thử lại!");
          }
      },
      error: function() {
          alert("Lỗi kết nối!");
      }
  });
}

// Sửa thông tin sách (AJAX)
function saveBookChanges() {
  var formData = new FormData(document.getElementById("editBookForm"));
  $.ajax({
      url: 'update_sach.php', // Tạo file PHP để xử lý dữ liệu
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
          if(response == 'success') {
              alert("Cập nhật thông tin sách thành công!");
              location.reload(); // Reload trang sau khi cập nhật
          } else {
              alert("Đã có lỗi xảy ra, vui lòng thử lại!");
          }
      },
      error: function() {
          alert("Lỗi kết nối!");
      }
  });
}

// Mở modal sửa người dùng
function openEditModal(userId) {
  $.ajax({
      url: 'get_user.php', // Tạo file PHP để lấy thông tin người dùng
      type: 'GET',
      data: {id: userId},
      success: function(response) {
          var user = JSON.parse(response);
          $('#editId').val(user.id);
          $('#editTk').val(user.tk);
          $('#editMk').val(user.mk);
          $('#editEmail').val(user.email);
          $('#editSdt').val(user.sodienthoai);
          $('#editMasv').val(user.masv);
          $('#editRole').val(user.role);
          $('#EditModal').show();
      },
      error: function() {
          alert("Không thể lấy thông tin người dùng.");
      }
  });
}

// Mở modal sửa sách
function openEditBookModal(bookId) {
  $.ajax({
      url: 'get_sach.php', // Tạo file PHP để lấy thông tin sách
      type: 'GET',
      data: {id: bookId},
      success: function(response) {
          var book = JSON.parse(response);
          $('#editBookId').val(book.id);
          $('#editTensach').val(book.tensach);
          $('#editTacgia').val(book.tacgia);
          $('#editTheloai').val(book.theloai);
          $('#editMota').val(book.mota);
          $('#editSoluong').val(book.soluong);
          $('#editBookModal').show();
      },
      error: function() {
          alert("Không thể lấy thông tin sách.");
      }
  });
}

// Đóng modal sửa người dùng
function closeEditModal() {
  $('#EditModal').hide();
}

// Đóng modal sửa sách
function closeEditBookModal() {
  $('#editBookModal').hide();
}
// xóa người dùng
function confirmDeleteUser(id) {
    if (confirm("Bạn có chắc chắn muốn xóa người dùng này?")) {
        $.ajax({
            url: 'delete_user.php', // Đảm bảo URL PHP chính xác
            type: 'GET',
            data: { id: id },
            success: function(response) {
                if (response == 'success') {
                    alert("Xóa người dùng thành công.");
                    location.reload(); // Tải lại trang sau khi xóa
                } else {
                    alert("Lỗi khi xóa người dùng.");
                }
            },
            error: function() {
                alert("Lỗi kết nối khi xóa người dùng.");
            }
        });
    }
}

function confirmDeleteSach(id) {
    if (confirm("Bạn có chắc chắn muốn xóa sách này?")) {
        $.ajax({
            url: 'delete-book.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                if (response == 'success') {
                    alert("Xóa sách thành công.");
                    location.reload();
                } else {
                    alert("Lỗi khi xóa sách.");
                }
            },
            error: function() {
                alert("Lỗi kết nối khi xóa sách.");
            }
        });
    }
}
