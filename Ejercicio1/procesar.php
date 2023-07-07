<?php

if (!$_POST){
    header('Location:index.html');
}

function convertir($peso_colombiano, $moneda)
{
    $tasas = array(
        'USD' => 0.000239963,
        'EURO' => 0.000219957,
        'BOLIVAR VENEZOLANO' => 671.414,
        'SOL PERUANO' => 0.000869672
    );

    if (isset($tasas[$moneda])) {
        $precio = $tasas[$moneda];
        if (is_numeric($precio) && is_numeric($peso_colombiano)) {
            $total = $peso_colombiano * $precio;
            $total_con_comas = number_format($total, 2, ',', '.');
            $precio_con_comas = number_format($precio, 7);
            return array(number_format($peso_colombiano, 0, ',', '.'), $moneda, $total_con_comas, $precio_con_comas);
        }
    }

    echo "El valor no es numérico o la divisa no es válida.";
    return null;
}

$peso_colombiano = $_POST['peso_colombiano'];
$moneda = $_POST['moneda'];

$resultado = convertir($peso_colombiano, $moneda);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos.css" rel="stylesheet" type="text/css">

    <title>Convertir moneda</title>
</head>

<body class="formulario" style="background-image: url('https://i.pinimg.com/564x/ed/ab/81/edab81c76164e4513ea964dd707167b3.jpg'); background-origin: border-box;"><br>

    <h1>CONVERSIÓN:</h1>

    <?php
    if ($resultado) {
        echo 'El total de ' . $resultado[0] . ' pesos colombianos en '
        . $resultado[1] . ' es ' . $resultado[2] . ' (con una tasa de cambio de ' . $resultado[3] . ')';
    }
    ?><br><br>

    <button onclick="window.history.back()" class="formulario__submit">Volver</button>

</body>

</html>
