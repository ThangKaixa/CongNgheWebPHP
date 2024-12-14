<?php
// Đọc dữ liệu từ file JSON
$flowers = json_decode(file_get_contents('flowers.json'), true);

// Xử lý thêm hoa
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $description = $_POST['description'];

    // Di chuyển ảnh lên thư mục images
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    // Thêm hoa mới vào mảng
    $newFlower = [
        'id' => count($flowers) + 1,
        'name' => $name,
        'image' => $image,
        'description' => $description
    ];
    $flowers[] = $newFlower;

    // Lưu lại vào file JSON
    file_put_contents('flowers.json', json_encode($flowers, JSON_PRETTY_PRINT));

    header('Location: Admin.php');
    exit();
}

// Xử lý xóa hoa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $flowers = array_filter($flowers, function($flower) use ($id) {
        return $flower['id'] != $id;
    });
    $flowers = array_values($flowers); // Re-index lại mảng

    // Lưu lại vào file JSON
    file_put_contents('flowers.json', json_encode($flowers, JSON_PRETTY_PRINT));

    header('Location: Admin.php');
    exit();
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

    header('Location: Admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị các loài hoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Quản lý các loài hoa</h1>
    </header>
    <main>
        <h2>Thêm loài hoa mới</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Tên hoa:</label>
            <input type="text" name="name" id="name" required>
            <label for="image">Ảnh hoa:</label>
            <input type="file" name="image" id="image" required>
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" required></textarea>
            <button type="submit" name="add">Thêm hoa</button>
        </form>

        <h2>Danh sách các loài hoa</h2>
        <table>
            <tr>
                <th>Tên hoa</th>
                <th>Ảnh hoa</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
            <?php foreach ($flowers as $flower): ?>
                <tr>
                    <td><?= htmlspecialchars($flower['name']) ?></td>
                    <td><img src="images/<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" width="100"></td>
                    <td><?= htmlspecialchars($flower['description']) ?></td>
                    <td>
                        <a href="Edit.php?id=<?= $flower['id'] ?>">Sửa</a> | 
                        <a href="Admin.php?delete=<?= $flower['id'] ?>">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <footer>
        <p>© 2024 Quản lý hoa</p>
    </footer>
</body>
</html>
