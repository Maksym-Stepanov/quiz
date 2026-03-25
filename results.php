<?php
require_once 'db.php';
$res = $mysqli->query("SELECT username, score, created_at FROM results ORDER BY score DESC, created_at DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Топ игроков</title>
</head>
<body>
    <div class="container">
        <h1>Топ 10 игроков</h1>
        <table>
            <tr><th>Игрок</th><th>Баллы</th></tr>
            <?php while($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['score'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php" class="btn">Играть снова</a>
    </div>
</body>
</html>