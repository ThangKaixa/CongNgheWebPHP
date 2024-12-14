<?php
session_start();

// Kiểm tra nếu có sản phẩm cần sửa
$productName = $_GET['name'] ?? '';
$product = null;
if ($productName) {
    $products = isset($_SESSION['products']) ? $_SESSION['products'] : [];
    foreach ($products as $prod) {
        if ($prod['name'] === $productName) {
            $product = $prod;
            break;
        }
    }
}

// Cập nhật sản phẩm nếu có dữ liệu gửi lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newProductName = $_POST['productName'];
    $newProductPrice = $_POST['productPrice'];

    // Sửa sản phẩm trong session
    if ($product) {
        $products = $_SESSION['products'];
        foreach ($products as &$prod) {
            if ($prod['name'] === $productName) {
                $prod['name'] = $newProductName;
                $prod['price'] = $newProductPrice;
            }
        }
        $_SESSION['products'] = $products;
    }

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Sửa sản phẩm</h1>

        <?php if ($product): ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="productName" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="productName" name="productName" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Giá thành</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?= htmlspecialchars($product['price']) ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                <a href="index.php" class="btn btn-secondary">Quay lại</a>
            </form>
        <?php else: ?>
            <p class="text-danger">Sản phẩm không tồn tại.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
