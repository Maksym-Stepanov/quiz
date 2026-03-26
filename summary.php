<?php
require_once 'db.php';
$username = $_POST['username'];
$score = 0;

$res = $mysqli->query("SELECT question_id, id FROM answers WHERE is_correct = 1");
$correct_map = [];
while($row = $res->fetch_assoc()) { $correct_map[$row['question_id']] = $row['id']; }

foreach ($_POST as $key => $val) {
    if (strpos($key, 'q') === 0) {
        $q_id = substr($key, 1);
        if (isset($correct_map[$q_id]) && $correct_map[$q_id] == $val) { $score++; }
    }
}

$stmt = $mysqli->prepare("INSERT INTO results (username, score) VALUES (?, ?)");
$stmt->bind_param("si", $username, $score);
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Wynik</title>
</head>
<body>
    <div class="container">
        <h1>Twój wynik</h1>
        <p>Gracz: <strong><?= htmlspecialchars($username) ?></strong></p>
        <div style="font-size: 48px; color: #1a73e8; margin: 20px 0;"><?= $score ?> / 10</div>
        <a href="results.php" class="btn">Tabela liderów</a>
    </div>
</body>
</html>