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
    <?php
    session_start();
    $us = $_SESSION["usuario"];
    if ($us == "") {
        header("Location: index.html");
    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="jefe.php">MY MED</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="jefe.php">Inventario de Medicamentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="editarInventario.php">Editar Medicamento</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="agregarUsuario.php">Agregar Nuevo Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jefe-compras.php">Compras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jefe-noti.php">Notificación de Medicamentos</a>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout <?php echo $us; ?></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- CSS -->
<style>
  .navbar-brand {
    font-weight: bold;
    font-size: 24px;
  }
  
  .navbar-nav .nav-link {
    font-weight: bold;
    color: #333;
    text-transform: uppercase;
    padding: 10px 15px;
  }
  
  .navbar-nav .nav-link.active {
    background-color: #ddd;
  }
  
  .navbar-nav .nav-link:hover {
    background-color: #eee;
  }
  
  .navbar-nav:last-child .nav-link {
    margin-left: auto;
  }
  
  .navbar-text a {
    color: #333;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 15px;
    border: 1px solid #333;
    border-radius: 4px;
  }
  
  .navbar-text a:hover {
    background-color: #333;
    color: #fff;
  }
</style>
    <div class="container">
        <div class="row">
    <table class="table table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">Id_Medicamento</th>
        <th scope="col">Nuevo Inventario</th>
        </tr>
    </thead>
            <?php
            $servurl = "http://192.168.100.2:3002/medicamentos";
            $curl = curl_init($servurl);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);

            if ($response === false) {
                curl_close($curl);
                die("Error en la conexion");
            }

            curl_close($curl);
            $resp = json_decode($response);
            $long = count($resp);
            for ($i = 0; $i < $long; $i++) {
                $dec = $resp[$i];
                $ID_MEDICAMENTO = $dec->ID_MEDICAMENTO;
                $INVENTARIO = $dec->INVENTARIO;
                
            ?>
                <tr>
                    <td><?php echo $ID_MEDICAMENTO; ?></td>
                    <td><?php echo $INVENTARIO; ?></td>
                    
                </tr>
            <?php
            }
            ?>
        </tbody>
        </div>
        </div>
    </table>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        EDITAR MEDICAMENTO
    </button>
    <div class="modal" id="exampleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDITAR MEDICAMENTO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="editarInv.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="formlabel">ID del medicamento</label>
                            <input type="text" name="ID_MEDICAMENTO" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nuevo Inventario</label>
                            <input type="text" name="INVENTARIO" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bsdismiss="modal">Close</button>
                            <button type="submit" class="btn
btn-primary">Editar</button>
                        </div>
                </div>
            </div>
        </div>
</body>

</html>
