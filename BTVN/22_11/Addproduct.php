<?php
session_start();

// Kiểm tra nếu có dữ liệu gửi từ form thì thêm sản phẩm vào session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Lấy danh sách sản phẩm từ session
    $products = isset($_SESSION['products']) ? $_SESSION['products'] : [];

    // Thêm sản phẩm mới vào danh sách
    $products[] = ['name' => $productName, 'price' => $productPrice];

    // Lưu lại danh sách vào session
    $_SESSION['products'] = $products;

    // Chuyển hướng về trang chính
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Thêm sản phẩm mới</h1>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="productName" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá thành</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
