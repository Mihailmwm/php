<?php

setcookie('test', '', time() - 3600);

if (!isset($_COOKIE['test'])) {
    echo "Кука с именем 'test' успешно удалена.";
} else {
    echo "Не удалось удалить куку с именем 'test'.";
}
?>
