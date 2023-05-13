<?php
session_start();
$us = $_SESSION["usuario"];
if ($us == "") {
    header("Location: index.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">YOU MED</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle
navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="user-compras.php">Comprar Medicamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-medic.php">Mis Compras</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Bienvenido, <?php echo $us; ?>
                </span>
            </div>
        </div>
    </nav>
    <form method="post" action="procesar.php">
      <input type="hidden" name="usuario" value="<?php echo $us; ?>">
  <div class="container mt-5">
    <h1 class="text-center">Lista de Medicamentos</h1>
    <div class="row mt-4">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Inventario</th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $servurl = "http://192.168.100.2:3002/medicamentos";
                $curl = curl_init($servurl);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                if ($response === false) {
                  curl_close($curl);
                  die("Error en la conexión");
                }
                curl_close($curl);
                $resp = json_decode($response);
                $long = count($resp);
                for ($i = 0; $i < $long; $i++) {
                  $dec = $resp[$i];
                  $ID_MEDICAMENTO = $dec->ID_MEDICAMENTO;
                  $DESCRIPCION = $dec->DESCRIPCION;
                  $PRECIO_UNITARIO = $dec->PRECIO_UNITARIO;
                  $INVENTARIO = $dec->INVENTARIO;
              ?>
              <tr>
                <td><?php echo $DESCRIPCION; ?></td>
                <td><?php echo "$" . number_format($PRECIO_UNITARIO, 2); ?></td>
                <td><?php echo $INVENTARIO; ?></td>
                <td>
                  <div class="form-group mb-0">
                    <input type="number" name="cantidad[<?php echo $ID_MEDICAMENTO; ?>]" class="form-control" value="0" min="0">
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
      </div>
    </div>
  </div>
</form>
    </body>
</html>
