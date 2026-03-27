<?php
require_once 'db.php';

if (isset($_POST['username']) && trim($_POST['username']) !== '') {
    $username = htmlspecialchars(trim($_POST['username']));
} else {
    $random_hash = bin2hex(random_bytes(4)); 
    $username = 'x' . $random_hash;
}

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
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz stolicy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div style="text-align: right; color: #5f6368; font-size: 0.9em; margin-bottom: 10px;">
        Nickname: <strong><?php echo $username; ?></strong>
    </div>
    
    <h1>Stolicy Europy</h1>

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

        <button type="submit" class="btn"><iKoniec</i></button>
    </form>
</div>

</body>
</html>