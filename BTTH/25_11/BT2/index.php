<?php
$file_path = "quiz.txt";
$questions = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$quiz = [];
$current_question = null;

// Phân tích nội dung file quiz.txt
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Kiểm Tra Trắc Nghiệm</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .question { margin-bottom: 20px; }
        .options { margin-left: 20px; }
        .submit-btn { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Bài Kiểm Tra Trắc Nghiệm</h1>
    <form method="POST" action="result.php">
        <?php foreach ($quiz as $index => $q): ?>
            <div class="question">
                <p><strong>Câu <?= $index + 1 ?>:</strong> <?= $q['question'] ?></p>
                <div class="options">
                    <?php foreach ($q['options'] as $option): ?>
                        <label>
                            <input type="radio" name="answer_<?= $index ?>" value="<?= substr($option, 0, 1) ?>"> 
                            <?= $option ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="submit-btn">Nộp Bài</button>
    </form>
</body>
</html>
