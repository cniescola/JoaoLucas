<?php

    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];
    $env = $_POST['env'];
    $resultado = 0;

    if($env == '+'){
        $resultado = $valor1 + $valor2;
    }else if($env == '-'){
        $resultado = $valor1 - $valor2;
    }else if($env == '*'){
        $resultado = $valor1 * $valor2;
    }else if($env == '/'){
        $resultado = $valor1 / $valor2;
    }

    echo "o resultado é $resultado";


?>