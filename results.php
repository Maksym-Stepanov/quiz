<?php
require_once 'db.php';
$res = $mysqli->query("SELECT username, score, created_at FROM results ORDER BY score DESC, created_at DESC LIMIT 10");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Top graczej</title>
</head>
<body>
    <div class="container">
        <h1>Top 10 graczy</h1>
        <table>
            <tr><th>Gracz</th><th>Score</th></tr>
            <?php while($row = $res->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['score'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php" class="btn">Zagraj ponownie</a>
    </div>
</body>
</html>