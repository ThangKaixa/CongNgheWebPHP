<?php
// Đường dẫn tới file CSV
$csvFile = "data.csv";

// Kiểm tra file có tồn tại không
if (!file_exists($csvFile)) {
    die("Tệp CSV không tồn tại.");
}

// Mở file CSV
$fileHandle = fopen($csvFile, "r");

// Đọc dữ liệu từ CSV
$headers = fgetcsv($fileHandle); // Lấy hàng đầu tiên làm tiêu đề cột
$data = [];
while (($row = fgetcsv($fileHandle)) !== false) {
    $data[] = $row;
}

// Đóng file
fclose($fileHandle);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Danh Sách Tài Khoản</h1>
    <table>
        <thead>
            <tr>
                <?php foreach ($headers as $header): ?>
                    <th><?= htmlspecialchars($header) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?= htmlspecialchars($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
