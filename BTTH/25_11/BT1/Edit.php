<?php
// Đọc dữ liệu từ file JSON
$flowers = json_decode(file_get_contents('flowers.json'), true);

// Lấy thông tin hoa cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $flower = null;
    foreach ($flowers as $f) {
        if ($f['id'] == $id) {
            $flower = $f;
            break;
        }
    }
    if (!$flower) {
        die("Không tìm thấy hoa");
    }
}

// Xử lý sửa hoa
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'] ?: $_POST['current_image'];

    if ($_FILES['image']['name']) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
    }

    // Tìm hoa cần sửa và cập nhật thông tin
    foreach ($flowers as &$flower) {
        if ($flower['id'] == $id) {
            $flower['name'] = $name;
            $flower['image'] = $image;
            $flower['description'] = $description;
        }
    }

    // Lưu lại vào file JSON
    file_put_contents('flowers.json', json_encode($flowers, JSON_PRETTY_PRINT));

    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin hoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sửa thông tin loài hoa</h1>
    </header>
    <main>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $flower['id'] ?>">
            <label for="name">Tên hoa:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($flower['name']) ?>" required>
            <label for="image">Ảnh hoa:</label>
            <input type="file" name="image" id="image">
            <input type="hidden" name="current_image" value="<?= htmlspecialchars($flower['image']) ?>">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($flower['description']) ?></textarea>
            <button type="submit" name="edit">Lưu thay đổi</button>
        </form>
    </main>
    <footer>
        <p>© 2024 Quản lý hoa</p>
    </footer>
</body>
</html>
