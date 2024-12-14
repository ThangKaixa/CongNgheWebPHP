<?php
// Đọc dữ liệu từ file JSON
$flowers = json_decode(file_get_contents('flowers.json'), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Danh sách các loài hoa</h1>
    </header>
    <main>
        <div class="flower-container">
            <?php foreach ($flowers as $flower): ?>
                <div class="flower">
                    <img src="images/<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>">
                    <h2><?= htmlspecialchars($flower['name']) ?></h2>
                    <p><?= htmlspecialchars($flower['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>© 2024 Các loài hoa đẹp</p>
    </footer>
</body>
</html>
