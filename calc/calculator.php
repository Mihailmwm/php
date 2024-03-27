<?php
require_once 'trigonometry.php';

function transformExpression($expression) {
    $arguments = interpretExpression($expression);
    return calculateExpression($arguments);
}

function interpretExpression($expression) {
    preg_match_all('/(-?\d+\.?\d*)|([\+\-\*\/\(\)])|(sin|cos|tan|cot)/', $expression, $matches);
    $arguments = $matches[0];

    $interpreted = [];
    for ($i = 0; $i < count($arguments); $i++) {
        if (in_array($arguments[$i], ['sin', 'cos', 'tan', "cot"]) && is_numeric($arguments[$i + 1])) {
            $interpreted[] = ['function' => $arguments[$i], 'argument' => $arguments[$i + 1]];
            $i++;
        } else {
            $interpreted[] = $arguments[$i];
        }
    }

    return $interpreted;
}

function calculateExpression($arguments) {
    $index = 0;
    return transformToFormula($arguments, $index);
}

function transformToFormula(&$arguments, &$index) {
    $result = parseExpression($arguments, $index);

    while ($index < count($arguments) && (in_array($arguments[$index], ['+', '-']))) {
        $operator = $arguments[$index++];
        $operand = parseExpression($arguments, $index);

        if ($operator == '+') {
            $result += $operand;
        } else {
            $result -= $operand;
        }
    }

    return $result;
}

function parseExpression(&$arguments, &$index) {
    $result = outputFactor($arguments, $index);

    while ($index < count($arguments) && (in_array($arguments[$index], ['*', '/']))) {
        $operator = $arguments[$index++];
        $operand = outputFactor($arguments, $index);

        if ($operator == '*') {
            $result *= $operand;
        } else {
            $result /= $operand;
        }
    }

    return $result;
}

function outputFactor(&$arguments, &$index) {
    if (is_numeric($arguments[$index]) || ($arguments[$index] == '-' && is_numeric($arguments[$index + 1]))) {
        $result = $arguments[$index++];
        if ($result == '-' && is_numeric($arguments[$index])) {
            $result .= $arguments[$index++];
        }
    } elseif (in_array($arguments[$index], ['sin', 'cos', 'tan', 'cot'])) {
        $func = $arguments[$index++];
        $arg = transformToFormula($arguments, $index);
        $result = convertToRadians($func, $arg);
    } elseif ($arguments[$index] == '(') {
        $index++;
        $result = transformToFormula($arguments, $index);
        $index++;
    }

    return $result;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['expression'])) {
        $expression = $_POST['expression'];
        $result = transformExpression($expression);
        echo $result;
    }
}
?>