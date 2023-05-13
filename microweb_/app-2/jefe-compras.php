<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Compras</title>
</head>

<body>
    <?php
    session_start();
    $us = $_SESSION["usuario"];
    if ($us == "") {
        header("Location: index.html");
    }
    ?>
    <?php include("navbar.php") ?>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Usuario</th>
            <th scope="col">ID Medicamento</th>
            <th scope="col">Nombre Medicamento</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Total Med.</th>
            <th scope="col">Total Cuenta</th>
            <th scope="col">Fecha Compra</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $servurl = "http://192.168.100.2:3003/compras/$us";
            $curl = curl_init($servurl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            if ($response === false) {
                curl_close($curl);
                die("Error en la conexion");
            }
            curl_close($curl);
            $resp = json_decode($response);
            echo "<script>console.log('$servurl');</script>";
            if (is_object($resp)) {
                $long = count((array)$resp);
                foreach (get_object_vars($resp) as $key => $value) {
                    $long = count($value->record);
                    
                    for ($i = 0; $i < $long; $i++) {
                        $dec = $value->record[$i];
                        $id = $dec->id;
                        $usuario = $dec->usuario;
                        $medicamento_nombre = $dec->medicamentoNombre;
                        $cantidad = $dec->cantidad;
                        $precio_total = $dec->precioTotal;
                        $medicamento_id = $dec->medicamentoId;
                        $compra_id = $dec->comprasId;
                        $totalCuenta = $dec->totalCuenta;
                        $fechaCompra = $dec->FechaCompra;
                        if ($i == 0) {
                            ?>
                                <tr>
                                    <td rowspan="<?php echo $value->len; ?>"><?php echo $usuario; ?></td>
                                    <td><?php echo $medicamento_id; ?></td>
                                    <td><?php echo $medicamento_nombre; ?></td>
                                    <td>#<?php echo $cantidad; ?></td>
                                    <td>$<?php echo $precio_total; ?></td>
                                    <td rowspan="<?php echo $value->len; ?>"><?php echo $totalCuenta; ?></td>
                                    <td rowspan="<?php echo $value->len; ?>"><?php echo $fechaCompra; ?></td>
                                </tr>
                            <?php
                        } else {
                            ?>
                                <tr>
                                    <td><?php echo $medicamento_id; ?></td>
                                    <td><?php echo $medicamento_nombre; ?></td>
                                    <td>#<?php echo $cantidad; ?></td>
                                    <td>$<?php echo $precio_total; ?></td>
                                </tr>
                            <?php

                        }
                    }
                }
            }
            if (is_object($resp)) {
                $long = count($resp);
                echo $long;
                echo "-----";
                for ($i = 0; $i < $long; $i++) {
                    $dec = $resp[$i];
                    $id = $dec->id;
                    $usuario = $dec->usuario;
                    $medicamento_nombre = $dec->medicamentoNombre;
                    $cantidad = $dec->cantidad;
                    $precio_total = $dec->precioTotal;
                    $medicamento_id = $dec->medicamentoId;
                    $compra_id = $dec->comprasId;
                    $totalCuenta = $dec->totalCuenta;
                    $fechaCompra = $dec->FechaCompra;
                    

                ?>
                    <tr>
                        <td><?php echo $usuario; ?></td>
                        <td><?php echo $medicamento_id; ?></td>
                        <td><?php echo $medicamento_nombre; ?></td>
                        <td>#<?php echo $cantidad; ?></td>
                        <td>$<?php echo $precio_total; ?></td>
                        <td>$<?php echo $totalCuenta; ?></td>
                        <td><?php echo $fechaCompra; ?></td>
                    </tr>
                <?php
            }}
            ?>  
    </tbody>
    </table>
        </div>
    </div>

</body>
