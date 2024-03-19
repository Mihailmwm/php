<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $expression = $_POST['expression'];
        $result = calculateExpression($expression);
        echo $result;
    } catch (Exception $e) {
        echo 'Error';
    }
}

function calculateExpression($expression) {
    try {
        $expression = str_replace(' ', '', $expression);
        return calculateAdditionAndSubtraction($expression);
    } catch (Exception $e) {
        throw new Exception('Error');
    }
}

function calculateAdditionAndSubtraction(&$expression) {
    try {
        $result = calculateMultiplicationAndDivision($expression);

        while (strlen($expression) > 0) {
            $operation = $expression[0];

            if ($operation == '+' || $operation == '-') {
                $expression = substr($expression, 1);
                $num2 = calculateMultiplicationAndDivision($expression);

                if ($operation == '+') {
                    $result += $num2;
                } elseif ($operation == '-') {
                    $result -= $num2;
                }
            } else {
                break;
            }
        }

        return $result;
    } catch (Exception $e) {
        throw new Exception('Error');
    }
}

function calculateMultiplicationAndDivision(&$expression) {
    try {
        $result = calculateNumber($expression);

        while (strlen($expression) > 0) {
            $operation = $expression[0];

            if ($operation == '*' || $operation == '/') {
                $expression = substr($expression, 1);
                $num2 = calculateNumber($expression);

                if ($operation == '*') {
                    $result *= $num2;
                } elseif ($operation == '/') {
                    if ($num2 == 0) {
                        throw new Exception('Error');
                    }
                    $result /= $num2;
                }
            } else {
                break;
            }
        }

        return $result;
    } catch (Exception $e) {
        throw new Exception('Error');
    }
}

function calculateNumber(&$expression) {
    try {
        if ($expression[0] == '(') {
            $expression = substr($expression, 1);
            $result = calculateAdditionAndSubtraction($expression);
            if ($expression[0] == ')') {
                $expression = substr($expression, 1);
            } else {
                throw new Exception('Error');
            }

            return $result;
        }

        $number = "";
        $isNegative = false;

        while (strlen($expression) > 0 && ($expression[0] == '-' || is_numeric($expression[0]))) {
            if ($expression[0] == '-') {
                if ($number !== "") {
                    break;
                }
                $isNegative = !$isNegative;
            } else {
                $number .= $expression[0];
            }

            $expression = substr($expression, 1);
        }

        if ($number === "") {
            throw new Exception('Error');
        }

        $number = intval($number);
        return ($isNegative) ? -$number : $number;
    } catch (Exception $e) {
        throw new Exception('Error');
    }
}
?>