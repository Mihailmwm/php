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

// 

include 'db.php';

$message = $_POST['message'];
$hashtag = $_POST['hashtag'];
$author = $_POST['author'];
$channel_id = $_POST['channel_id'];

$user_check_sql = "SELECT id FROM users WHERE username='$author'";
$user_check_result = $conn->query($user_check_sql);

if ($user_check_result->num_rows > 0) {
    $row = $user_check_result->fetch_assoc();
    $author_id = $row["id"];
} else {
    $add_user_sql = "INSERT INTO users (username) VALUES ('$author')";
    if ($conn->query($add_user_sql) === TRUE) {
        $author_id = $conn->insert_id;
    } else {
        echo "Ошибка при добавлении пользователя: " . $conn->error;
        exit();
    }
}

$hashtag_check_sql = "SELECT id FROM hashtags WHERE hashtag='$hashtag'";
$hashtag_check_result = $conn->query($hashtag_check_sql);

if ($hashtag_check_result->num_rows > 0) {
    $row = $hashtag_check_result->fetch_assoc();
    $hashtag_id = $row["id"];
} else {
    $add_hashtag_sql = "INSERT INTO hashtags (hashtag) VALUES ('$hashtag')";
    if ($conn->query($add_hashtag_sql) === TRUE) {
        $hashtag_id = $conn->insert_id;
    } else {
        echo "Ошибка при добавлении хэштега: " . $conn->error;
        exit();
    }
}

$sql = "INSERT INTO messages (message, hashtag_id, author_id, channel_id) VALUES ('$message', '$hashtag_id', '$author_id', '$channel_id')";

if ($conn->query($sql) === TRUE) {
    echo "Сообщение успешно добавлено";
} else {
    echo "Ошибка при добавлении сообщения: " . $conn->error;
}

$conn->close();
?>

</body>
</html>