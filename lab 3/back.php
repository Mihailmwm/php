<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $url = 'https://e.mospolytech.ru';

    print_r(get_headers($url));
    
    print_r(get_headers($url, 1));
    ?>
    <a href="index.html"> 1 page</a>
</body>

</html>

