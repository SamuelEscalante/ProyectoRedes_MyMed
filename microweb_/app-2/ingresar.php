<?php
    $user=$_POST["usuario"];
    $pass=$_POST["password"];

    $servurl="http://192.168.100.2:3001/usuarios/$user/$pass";
    $curl=curl_init($servurl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response=curl_exec($curl);
    curl_close($curl);

    if ($response===false){
        header("Location:index.html");
    }
    $resp = json_decode($response);

    if (count($resp) != 0){
        session_start();
        $_SESSION["usuario"]=$user;
        $_SESSION["jefe"]=$resp[0] -> {"jefe"};
        if ($_SESSION["jefe"] == 1){ 
            header("Location:jefe.php");
        } 
        else {
            header("Location:usuario.php");
        } 
    }
    else {
    header("Location:index.html"); 
    }