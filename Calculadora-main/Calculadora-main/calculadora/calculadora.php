<?php
session_start();

class Calculadora {
    public static function adicionar($num1, $num2) {
        return $num1 + $num2;
    }

    public static function subtrair($num1, $num2) {
        return $num1 - $num2;
    }

    public static function multiplicar($num1, $num2) {
        return $num1 * $num2;
    }

    public static function dividir($num1, $num2) {
        if ($num2 == 0) {
            return "Erro: Divisão por zero!";
        } else {
            return $num1 / $num2;
        }
    }

    public static function fatorial($num) {
        if ($num == 0) {
            return 1;
        } else {
            return $num * self::fatorial($num - 1);
        }
    }

    public static function potencia($num1, $num2) {
        return pow($num1, $num2);
    }
}

if (isset($_POST['submit'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operacao = $_POST['operacao'];
    
    switch ($operacao) {
        case '+':
            $resultado = Calculadora::adicionar($num1, $num2);
            break;
        case '-':
            $resultado = Calculadora::subtrair($num1, $num2);
            break;
        case '*':
            $resultado = Calculadora::multiplicar($num1, $num2);
            break;
        case '/':
            $resultado = Calculadora::dividir($num1, $num2);
            break;
        case '!':
            $resultado = Calculadora::fatorial($num1);
            break;
        case '^':
            $resultado = Calculadora::potencia($num1, $num2);
            break;
        default:
            $resultado = "Operação inválida";
    }

    $_SESSION['historico'][] = array('num1' => $num1, 'num2' => $num2, 'operacao' => $operacao, 'resultado' => $resultado);
}

if (isset($_POST['limpar_historico'])) {
    unset($_SESSION['historico']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }

        h1 {
            color: #800080;
        }

        form {
            display: inline-block;
            margin-top: 20px;
        }

        input[type="text"], select, input[type="submit"] {
            margin: 5px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #800080;
            color: #fff;
            cursor: pointer;
        }

        h2 {
            color: #800080;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        li:last-child {
            margin-bottom: 20px;
        }

        input[type="submit"].limpar {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
    <h1>Calculadora em PHP</h1>
    <form method="post">
        <input type="text" name="num1" placeholder="Número 1" required>
        <input type="text" name="num2" placeholder="Número 2" required>
        <select name="operacao">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="!">fatorial</option>
            <option value="^">potência</option>
        </select>
        <input type="submit" name="submit" value="Calcular">
    </form>
    
    <?php if (isset($resultado)) : ?>
        <h2>Resultado: <?php echo $resultado; ?></h2>
    <?php endif; ?>

    <h2>Histórico</h2>
    <ul>
        <?php if (isset($_SESSION['historico'])) : ?>
            <?php foreach ($_SESSION['historico'] as $operacao) : ?>
                <li>
                    <?php echo $operacao['num1'] . ' ' . $operacao['operacao'] . ' ' . $operacao['num2'] . ' = ' . $operacao['resultado']; ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <form method="post">
        <input type="submit" name="limpar_historico" value="Limpar Histórico" class="limpar">
    </form>
</body>
</html>