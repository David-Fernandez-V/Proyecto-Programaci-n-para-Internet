<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $codigo = $_REQUEST['codigo'];
    $descripcion = $_REQUEST['descripcion'];
    $stock = (int)$_REQUEST['stock'];
    $precio = (float)$_REQUEST['costo'];
    
    $nombre_archivo = $_FILES['foto']['name'];
    $archivo = $_FILES['foto']['tmp_name'];
        
    $sql = "UPDATE productos SET nombre='$nombre', codigo='$codigo', descripcion='$descripcion', stock=$stock, costo=$precio";
    if (is_uploaded_file($archivo)) {
        $arreglo = explode(".",$nombre_archivo);
        $len = count($arreglo);
        $pos = $len-1;
        $ext = $arreglo[$pos];
        $dir = "archivos/";
        $archivo_encriptado = md5_file($archivo);   
        
        $nombre_archivo_enc = "$archivo_encriptado.$ext";
        copy($archivo, $dir.$nombre_archivo_enc);

        $sql .= ", archivo_nombre='$nombre_archivo', archivo='$nombre_archivo_enc'";
    }
    $sql.= " WHERE id=$id";

    $res = $con->query($sql);
    header("Location: productos_lista.php");  
?>