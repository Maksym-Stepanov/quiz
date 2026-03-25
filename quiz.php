<?php
require_once 'db.php';

// 1. Obsługa nazwy użytkownika
$raw_name = $_POST['username'] ?? '';
if (empty(trim($raw_name))) {
    // Generowanie losowego ciągu znaków i cyfr (np. User_a1b2c)
    $username = "User_" . substr(md5(uniqid()), 0, 5);
} else {
    $username = htmlspecialchars($raw_name);
}

// 2. Pobieranie pytań (Przykładowe zapytanie)
// Pobieramy 10 losowych pytań
$query = "SELECT q.id, q.question_text, a.id as answer_id, a.answer_text, a.label 
          FROM questions q 
          JOIN answers a ON q.id = a.question_id 
          ORDER BY q.id ASC";
$result = $mysqli->query($query);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['id']]['text'] = $row['question_text'];
    $questions[$row['id']]['answers'][] = $row;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Quiz - Powodzenia!</title>
</head>
<body>
    <div class="container">
        <p>Grasz jako: <strong><?php echo $username; ?></strong></p>
        <form action="summary.php" method="POST">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            
            <?php foreach ($questions as $q_id => $q_data): ?>
                <div class="question-block">
                    <h3><?php echo htmlspecialchars($q_data['text']); ?></h3>
                    <?php foreach ($q_data['answers'] as $ans): ?>
                        <label class="answer-item">
                            <input type="radio" name="q<?php echo $q_id; ?>" value="<?php echo $ans['answer_id']; ?>" required>
                            <?php echo $ans['label'] . ") " . htmlspecialchars($ans['answer_text']); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn">Wyślij odpowiedzi</button>
        </form>
    </div>
</body>
</html>