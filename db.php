<?php
$mysqli = new mysqli("localhost", "root", "", "quiz"); 
if ($mysqli->connect_error) { die("Ошибка: " . $mysqli->connect_error); }