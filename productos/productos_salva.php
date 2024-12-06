<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $nombre = $_REQUEST['nombre'];
    $codigo = $_REQUEST['codigo'];
    $descripcion = $_REQUEST['descripcion'];
    $stock = (int)$_REQUEST['stock'];
    $precio = (float)$_REQUEST['costo'];
    
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

    $sql = "INSERT INTO productos
            (nombre, codigo, descripcion, costo, stock, archivo_nombre, archivo)
            VALUES ('$nombre', '$codigo', '$descripcion', '$precio', $stock, '$nombre_archivo', '$nombre_archivo_enc')";

    $res = $con->query($sql);
    header("Location: productos_lista.php");  
?>