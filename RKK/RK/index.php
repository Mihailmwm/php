<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Webchat</title>
</head>
<body>
    <header>
        <h1>Webchat</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="add_message.php">Добавить сообщение</a></li>
                <li><a href="add_channel.php">Добавить канал</a></li>
                <li><a href="add_hashtag.php">Добавить хештег</a></li>
            </ul>
        </nav>
    </header>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: bisque;
}
header {
    background-color: #942626;
    padding: 10px;
    background: blueviolet;
}
header h1 {
    margin: 0;
}
nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
nav ul li {
    display: inline;
    margin-right: 10px;
}
main {
    padding: 20px;
}
section {
    margin-bottom: 20px;
}
h2 {
    margin-bottom: 10px;
}
.message-container {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
}
.message-container p {
    margin: 0;
}
.message-container p strong {
    margin-right: 5px;
}
.add-hashtag-link {
    display: block;
    margin-top: 20px;
    text-decoration: none;
    color: blue;
}
.add-hashtag-link:hover {
    text-decoration: underline;
}
    </style>

    <main>
        <?php
        include 'db.php';

$sections = array(
    "Природа и животные" => array("#кот", "#парк", "#пес", "#цветы", "трава"),
    "Мотоциклы" => array("#кросс", "#эндуро", "#спорт", "#чоппер"),
    "Отдых" => array("#море", "#пальма", "#горы", "#пикник")
);

$sections["Все сообщения"] = array();

foreach ($sections as $section_name => $hashtags) {
    echo "<section>";
    echo "<h2>$section_name</h2>";

    $condition = "";
    if ($section_name !== "Все сообщения") {
        foreach ($hashtags as $index => $hashtag) {
            if ($index > 0) {
                $condition .= " OR ";
            }
            $condition .= "messages.hashtag='$hashtag'";
        }
    }

    $sql = "SELECT messages.message, users.username, channels.channel_name, channels.trusted
            FROM messages
            INNER JOIN users ON messages.author_id = users.id
            INNER JOIN channels ON messages.channel_id = channels.id";
    if (!empty($condition)) {
        $sql .= " WHERE $condition";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='message-container'>";
            echo "<p><strong>Сообщение:</strong> " . $row["message"] . "</p>";
            echo "<p><strong>Автор:</strong> " . $row["username"] . "</p>";
            echo "<p><strong>Канал:</strong> " . $row["channel_name"];
            // echo "<p><strong>Хэш:</strong> " . $row["hashtags"];
            if ($row["trusted"] == 1) {
                echo " (Доверенный)";
            } else {
                echo " (Не доверенный)";
            }
            echo "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Нет сообщений</p>";    
    }
    echo "</section>";
}


?>

        <!-- <a href="add_hashtag.php" class="add-hashtag-link">Добавить хештег</a> -->
    </main>
    

</body>
</html>