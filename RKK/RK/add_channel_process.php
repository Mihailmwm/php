<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'db.php';

$channel_name = $_POST['channel_name'];
$trusted = isset($_POST['trusted']) ? 1 : 0;

$sql = "INSERT INTO channels (channel_name, trusted) VALUES ('$channel_name', '$trusted')";

if ($conn->query($sql) === TRUE) {
    echo "Канал успешно добавлен";
} else {
    echo "Ошибка при добавлении канала: " . $conn->error;
}

$conn->close();
?>
</body>
</html>