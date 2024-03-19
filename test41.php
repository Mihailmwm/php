<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$string = 'aaa bcd xxx efg';
preg_match_all('/(\b\w)\1+\b/', $string, $matches);

$result = implode(" ", $matches[0]);
echo $result; 

?>







</body>
</html>