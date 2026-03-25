<?php
require_once 'db.php';
$query = "SELECT username, score, created_at FROM results ORDER BY created_at DESC";
$res = $mysqli->query($query);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Ranking</title>
</head>
<body>
    <div class="container">
        <h1>Tabela Wyników</h1>
        <table>
            <thead>
                <tr>
                    <th>Gracz</th>
                    <th>Wynik</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $res->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo $row['score']; ?>/10 (<?php echo $row['score']*10; ?>%)</td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="index.php" class="btn">Zagraj ponownie</a>
    </div>
</body>
</html>