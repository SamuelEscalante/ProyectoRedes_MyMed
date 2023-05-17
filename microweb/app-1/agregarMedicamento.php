<?php
$DESCRIPCION = $_POST["DESCRIPCION"];
$Laboratorio = $_POST["Laboratorio"];
$Condicion_Venta = $_POST["Condicion_Venta"];
$PRECIO_UNITARIO = $_POST["PRECIO_UNITARIO"];
$FechaCompra = $_POST["FechaCompra"];
$FechaCaducidad = $_POST["FechaCaducidad"]
$Porcentaje_Efectividad = $_POST["Porcentaje_Efectividad"]
$INVENTARIO = $_POST["INVENTARIO"];

// URL de la solicitud POST
$url = 'http://192.168.100.2:3002/medicamentos';

// Datos que se enviarán en la solicitud POST
$data = array(
    'DESCRIPCION' => $DESCRIPCION,
    'Laboratorio' => $Laboratorio,
    'Condicion_Venta' => $Condicion_Venta,
    'PRECIO_UNITARIO' => $PRECIO_UNITARIO,
    'FechaCompra' => $FechaCompra
    'FechaCaducidad' => $FechaCaducidad
    'Porcentaje_Efectividad' => $Porcentaje_Efectividad
    'INVENTARIO' => $INVENTARIO,
);
$json_data = json_encode($data);

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
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
header("Location:jefe.php");
