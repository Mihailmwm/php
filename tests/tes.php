<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$a = 5.7;

$b = 8.3;

$c = '5.6';

$d = '9.2кг';



$a_rounded = round($a);

$b_rounded = round($b);

$c_rounded = round($c);

$d_rounded = round($d);



echo "Значение переменной a (пол): " . $a_rounded . "<br>";

echo "Значение переменной b (потолок): " . $b_rounded . "<br>";

echo "Значение переменной c (пол): " . $c_rounded . "<br>";

echo "Значение переменной d (потолок): " . $d_rounded . "<br>";

?>
</body>
</html>