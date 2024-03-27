<?php
function convertToRadians($function, &$argument) {
    try {
        $argument = deg2rad($argument);

        switch ($function) {
            case 'sin':
                return sin($argument);
            case 'cos':
                return cos($argument);
            case 'tan':
                return tan($argument);
            case "cot":
                return 1 / tan($argument);
            default:
                throw new Exception('Неверная функция');
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
?>