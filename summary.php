<?php
require_once 'db.php';

$username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : 'Anonim';
$score = 0;
$total_questions = 10;

// liczy punkty
$correct_query = "SELECT id FROM answers WHERE is_correct = 1";
$correct_result = $mysqli->query($correct_query);
$correct_ids = [];

if ($correct_result) {
    while ($row = $correct_result->fetch_assoc()) {
        $correct_ids[] = $row['id'];
    }
}

// sprawdza odpowiedzi wyslane przez uzytkownika
foreach ($_POST as $key => $value) {
    
    if (strpos($key, 'q') === 0) {
        if (in_array($value, $correct_ids)) {
            $score++;
        }
    }
}


// Zapisuje wynik w tabel resultat
$stmt = $mysqli->prepare("INSERT INTO results (username, score) VALUES (?, ?)");
$stmt->bind_param("si", $username, $score); 
$stmt->execute();
$stmt->close();

$summary_text = "";

if ($score == 10) {
    $summary_text = "Doskonale! Jesteś mistrzem!";
} elseif ($score >= 7) {
    $summary_text = "Bardzo dobry wynik!";
} elseif ($score >= 5) {
    $summary_text = "Dobrze, ale mogło być lepiej.";
} else {
    $summary_text = "Musisz jeszcze poćwiczyć.";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie Quizu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Koniec Quizu!</h1>
        
        <div class="result-box">
            <p>Gracz: <strong><?= $username ?></strong></p>
            <h2>Twój wynik: <?= $score ?> / <?= $total_questions ?></h2>
            
            <p class="summary-message"><?= $summary_text ?></p>
        </div>

        <div class="actions">
            <a href="results.php" class="btn">Zobacz Ranking</a>
            <a href="index.php" class="btn secondary">Zagraj ponownie</a>
        </div>
    </div>
</body>
</html>