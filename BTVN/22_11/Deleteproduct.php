<?php
session_start();

// Lấy danh sách sản phẩm từ session
$products = isset($_SESSION['products']) ? $_SESSION['products'] : [];

// Lấy tên sản phẩm cần xóa từ query string
$productName = isset($_GET['name']) ? $_GET['name'] : '';

// Xóa sản phẩm khỏi danh sách
foreach ($products as $key => $product) {
    if ($product['name'] === $productName) {
        unset($products[$key]);
        break;
    }
}

// Đánh lại chỉ số mảng và lưu lại vào session
$_SESSION['products'] = array_values($products);

// Quay lại trang quản lý
header('Location: index.php');
exit();
