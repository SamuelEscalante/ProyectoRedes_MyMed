<?php
ob_start();
if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
} else {
    $usuario = null; // Asignar un valor por defecto cuando no se proporciona un usuario
}

$items = array(); // Inicializar la variable $items como un array vacío

// Recorrer los valores de cantidad enviados por el formulario
if (isset($_POST['cantidad']) && is_array($_POST['cantidad'])) {
    foreach ($_POST['cantidad'] as $ID_MEDICAMENTO => $cantidad) {
        if ($cantidad > 0) {
            $item['ID_MEDICAMENTO'] = $ID_MEDICAMENTO;
            $item["cantidad"] = $cantidad;
            array_push($items, $item);
        }
    }
}

$orden['usuario'] = $usuario;
$orden['items'] = $items;

$json = json_encode($orden);
//echo $json;

$url = 'http://192.168.100.2:3003/compras';

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud POST
$response = curl_exec($ch);

// Manejar la respuesta
if ($response === false) {
    header("Location:index.html");
}

// Cerrar la conexión cURL
curl_close($ch);
ob_end_flush();
?>

