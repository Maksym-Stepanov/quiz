<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'quiz'; // Zmieniono z quiz_db na quiz

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");
?>