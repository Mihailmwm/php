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
// include 'db.php';

// $hashtag = $_POST['hashtag'];

// $sql = "INSERT INTO hashtags (hashtag) VALUES ('$hashtag')";

// if ($conn->query($sql) === TRUE) {
//     echo "Хештег успешно добавлен";
// } else {
//     echo "Ошибка при добавлении хештега: " . $conn->error;
// }

// $conn->close();

// 

include 'db.php';

$hashtag = $_POST['hashtag'];

// Check if the hashtag already exists in the database
$checkQuery = "SELECT COUNT(*) FROM hashtags WHERE hashtag = '$hashtag'";
$result = $conn->query($checkQuery);
$count = $result->fetch_row()[0];

if ($count > 0) {
    echo "Хештег уже существует";
} else {
    // Insert the hashtag into the database
    $sql = "INSERT INTO hashtags (hashtag) VALUES ('$hashtag')";

    if ($conn->query($sql) === TRUE) {
        echo "Хештег успешно добавлен";
    } else {
        echo "Ошибка при добавлении хештега: " . $conn->error;
    }
}

$conn->close();

?>
</body>
</html>