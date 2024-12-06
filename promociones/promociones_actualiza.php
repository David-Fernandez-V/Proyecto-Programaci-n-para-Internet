<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    
    $nombre_archivo = $_FILES['foto']['name'];
    $archivo = $_FILES['foto']['tmp_name'];
        
    $sql = "UPDATE promociones SET nombre='$nombre'";
    if (is_uploaded_file($archivo)) {
        $arreglo = explode(".",$nombre_archivo);
        $len = count($arreglo);
        $pos = $len-1;
        $ext = $arreglo[$pos];
        $dir = "archivos/";
        $archivo_encriptado = md5_file($archivo);   
        
        $nombre_archivo_enc = "$archivo_encriptado.$ext";
        copy($archivo, $dir.$nombre_archivo_enc);

        $sql .= ", archivo='$nombre_archivo_enc'";
    }
    $sql.= " WHERE id=$id";

    $res = $con->query($sql);
    header("Location: promociones_lista.php");  
?>