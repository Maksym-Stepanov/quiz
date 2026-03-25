<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $score = 0;
    $totalQuestions = 0;

    // 1. Pobieramy poprawne odpowiedzi z bazy, aby porównać je z wysłanymi danymi
    $sql = "SELECT question_id, id FROM answers WHERE is_correct = 1";
    $result = $mysqli->query($sql);
    
    $correctAnswers = [];
    while ($row = $result->fetch_assoc()) {
        $correctAnswers[$row['question_id']] = $row['id'];
    }

    // 2. Sprawdzamy odpowiedzi użytkownika
    foreach ($_POST as $key => $value) {
        // Klucze w $_POST dla pytań wyglądają tak: q1, q2, q3...
        if (strpos($key, 'q') === 0) {
            $questionId = substr($key, 1); // wycinamy literę 'q', zostaje ID pytania
            if (isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] == $value) {
                $score++;
            }
            $totalQuestions++;
        }
    }

    // 3. Zapis do bazy danych (Prepared Statement - Ochrona przed SQL Injection)
    $stmt = $mysqli->prepare("INSERT INTO results (username, score) VALUES (?, ?)");
    $stmt->bind_param("si", $username, $score);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Twój Wynik</title>
</head>
<body>
    <div class="container">
        <h1>Koniec Quizu!</h1>
        <p>Gracz: <strong><?php echo htmlspecialchars($username); ?></strong></p>
        <p>Twój wynik to: <span style="font-size: 24px; color: #27ae60;">
            <?php echo $score; ?> / <?php echo $totalQuestions; ?>
        </span></p>
        
        <hr>
        <div style="display: flex; gap: 10px;">
            <a href="index.php" class="btn">Zagraj jeszcze raz</a>
            <a href="results.php" class="btn" style="background: #2c3e50;">Zobacz ranking</a>
        </div>
    </div>
</body>
</html>