<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <?php
         $sum = 0;
         $count = 1;
         
         while ($count <= 15) {
             if ($count % 3 === 0) {
                 $sum += $count;
             }
             $count++;
         }
         
         echo "Сумма первых 15 членов натурального ряда кратных 3 (цикл с предусловием): " . $sum;
         
         ?>
</body>
</html>