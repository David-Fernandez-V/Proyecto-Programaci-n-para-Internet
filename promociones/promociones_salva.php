<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $nombre = $_REQUEST['nombre'];
    $nombre_archivo = $_FILES['foto']['name'];
    $archivo = $_FILES['foto']['tmp_name'];

    $arreglo = explode(".",$nombre_archivo);
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $dir = "archivos/";
    $archivo_encriptado = md5_file($archivo);

    $nombre_archivo_enc = "$archivo_encriptado.$ext";
    copy($archivo, $dir.$nombre_archivo_enc);

    $sql = "INSERT INTO promociones
            (nombre, archivo)
            VALUES ('$nombre', '$nombre_archivo_enc')";

    $res = $con->query($sql);
    header("Location: promociones_lista.php");  
?>