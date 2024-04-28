
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Добавить канал</title>
</head>
<body>
    <h1>Добавить канал</h1>
    <form action="add_channel_process.php" method="post">
        <label>Название канала:</label>
        <input type="text" name="channel_name" required><br>
        <label>Доверенный:</label>
        <input type="checkbox" name="trusted" value="1"><br>
        <input type="submit" value="Добавить">
    </form>
</body>
</html>