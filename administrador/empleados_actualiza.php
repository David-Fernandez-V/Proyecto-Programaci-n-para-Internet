<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $id = $_REQUEST['id'];
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    $rol = $_REQUEST['rol'];

    $nombre_archivo = $_FILES['foto']['name'];
    $archivo= $_FILES['foto']['tmp_name'];
        
    $sql = "UPDATE empleados SET nombre='$nombre', apellidos='$apellidos', correo='$correo', rol=$rol";
    if (!empty($pass)) {
        $passEnc = md5($pass);
        $sql .= ", pass='$passEnc'";
    }
    if (is_uploaded_file($archivo)) {
        $arreglo = explode(".",$nombre_archivo);
        $len = count($arreglo);
        $pos = $len-1;
        $ext = $arreglo[$pos];
        $dir = "archivos/";
        $archivo_encriptado = md5_file($archivo);   
        
        $nombre_archivo_enc = "$archivo_encriptado.$ext";
        copy($archivo, $dir.$nombre_archivo_enc);

        $sql .= ", archivo_nombre='$nombre_archivo', archivo_file='$nombre_archivo_enc'";
    }
    $sql.= " WHERE id=$id";

    $res = $con->query($sql);
    header("Location: empleados_lista.php");  
?>