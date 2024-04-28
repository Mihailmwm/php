<?php
$servername = "localhost";
$username = "username";
$password = "aJR)/R_jd)3CkU*0";
$dbname = "my_social_network";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>