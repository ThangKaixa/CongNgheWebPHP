<?php
session_start();

// Lấy danh sách sản phẩm từ session
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Administration</h1>

        <!-- Menu -->
        <nav class="nav mb-4">
            <a class="nav-link" href="#">Trang chủ</a>
            <a class="nav-link" href="#">Trang ngoài</a>
            <a class="nav-link" href="#">Thể loại</a>
            <a class="nav-link" href="#">Tác giả</a>
            <a class="nav-link" href="#">Bài viết</a>
        </nav>

        <!-- Nút thêm sản phẩm -->
        <a href="Addproduct.php" class="btn btn-success mb-3">Thêm mới</a>

        <!-- Bảng sản phẩm -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá thành</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                            <td>
                                <a href="Editproduct.php?name=<?= urlencode($product['name']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete('<?= $product['name'] ?>')">Xóa</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có sản phẩm</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hàm xác nhận xóa
        function confirmDelete(productName) {
            if (confirm(`Bạn có chắc chắn muốn xóa sản phẩm "${productName}"?`)) {
                window.location.href = `Deleteproduct.php?name=${encodeURIComponent(productName)}`;
            }
        }
    </script>
</body>
</html>
