<?php
require_once 'db.php';

// 1. Логика генерации случайного имени (буквы + цифры)
if (isset($_POST['username']) && trim($_POST['username']) !== '') {
    // Если пользователь ввел имя, очищаем его от лишних пробелов
    $username = htmlspecialchars(trim($_POST['username']));
} else {
    // Если имя не введено, генерируем случайную строку (например: User_a1b2c3d4)
    $random_hash = bin2hex(random_bytes(4)); // Генерирует 8 случайных символов
    $username = 'x' . $random_hash;
}

// 2. Получаем вопросы и ответы из базы данных
$query = "SELECT q.id as q_id, q.question_text, a.id as a_id, a.answer_text, a.label 
          FROM questions q 
          JOIN answers a ON q.id = a.question_id 
          ORDER BY q.id, a.label";

$result = $mysqli->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['q_id']]['text'] = $row['question_text'];
    $questions[$row['q_id']]['answers'][] = $row;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Квиз по столицам</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div style="text-align: right; color: #5f6368; font-size: 0.9em; margin-bottom: 10px;">
        Игрок: <strong><?php echo $username; ?></strong>
    </div>
    
    <h1>Викторина: Столицы Европы</h1>

    <form action="summary.php" method="POST">
        <input type="hidden" name="username" value="<?php echo $username; ?>">

        <?php foreach ($questions as $id => $data): ?>
            <div class="question-item">
                <span class="question-text"><?php echo htmlspecialchars($data['text']); ?></span>
                
                <div class="answers-list">
                    <?php foreach ($data['answers'] as $ans): ?>
                        <label class="answer-option">
                            <input type="radio" name="q<?php echo $id; ?>" value="<?php echo $ans['a_id']; ?>" required>
                            <span>
                                <strong><?php echo $ans['label']; ?></strong> 
                                <?php echo htmlspecialchars($ans['answer_text']); ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn">Завершить и узнать результат</button>
    </form>
</div>

</body>
</html>