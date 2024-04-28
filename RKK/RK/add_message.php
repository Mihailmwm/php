<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Добавить сообщение</title>
</head>
<body>
    <h1>Добавить сообщение</h1>
    <form action="add_message_process.php" method="post">
        
        <label for="message">Сообщение:</label>
        <input id='message' type="text" name="message" required>
        <br>

        <label for="hashtag_id">Хештег:</label>
        <!-- <select id="hashtag"name="hashtag"> -->
        <input id='hashtag_id' type="text" name="hashtag" required>
        <br>

        <label for="author">Автор:</label>
        <input id='author' type="text" name="author" required>
        <!-- <select id="author"name="author_id"> -->
        <br>

        <label for="channel">Канал:</label>
        <select id='channel'name="channel_id">
            
            <?php
            include 'db.php';

            $sql = "SELECT * FROM channels";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["channel_name"] . "</option>";
                }
            } else {
                echo "<option value=''>Нет каналов</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>