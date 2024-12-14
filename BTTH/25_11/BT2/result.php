<?php
$file_path = "quiz.txt";
$questions = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$quiz = [];
$current_question = null;

// Phân tích file quiz.txt
foreach ($questions as $line) {
    if (strpos($line, "ANSWER:") !== false) {
        $current_question['answer'] = trim(str_replace("ANSWER:", "", $line));
        $quiz[] = $current_question;
        $current_question = null;
    } elseif (preg_match("/^[A-D]\./", $line)) {
        $current_question['options'][] = trim($line);
    } else {
        if ($current_question === null) {
            $current_question = ['question' => $line, 'options' => []];
        }
    }
}

// Tính điểm
$total_questions = count($quiz);
$correct_answers = 0;

foreach ($quiz as $index => $q) {
    $user_answer = $_POST["answer_$index"] ?? null; 
    if ($user_answer === $q['answer']) {
        $correct_answers++;
    }
}

// Hiển thị kết quả
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        .result { margin-top: 50px; }
        .score { font-size: 24px; font-weight: bold; color: green; }
    </style>
</head>
<body>
    <div class="result">
        <h1>Kết Quả Bài Kiểm Tra</h1>
        <p>Bạn đã trả lời đúng <span class="score"><?= $correct_answers ?></span> trên tổng số <?= $total_questions ?> câu hỏi.</p>
        <p>Điểm số của bạn: <strong><?= ($correct_answers / $total_questions) * 10 ?> / 10</strong></p>
        <a href="index.php">Làm lại bài kiểm tra</a>
    </div>
</body>
</html>
