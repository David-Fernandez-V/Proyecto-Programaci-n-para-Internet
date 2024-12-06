<?php
    require "../funciones/conecta.php";
    $con = conecta();
    
    //Recibe variables
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    $rol = $_REQUEST['rol'];
    $pass_encriptada = md5($pass);

    $nombre_archivo = $_FILES['foto']['name'];
    $archivo= $_FILES['foto']['tmp_name'];
    $arreglo = explode(".",$nombre_archivo);
    $len = count($arreglo);
    $pos = $len-1;
    $ext = $arreglo[$pos];
    $dir = "archivos/";
    $archivo_encriptado = md5_file($archivo);   
    
    $nombre_archivo_enc = "$archivo_encriptado.$ext";
    copy($archivo, $dir.$nombre_archivo_enc); 

    $sql = "INSERT INTO empleados
            (nombre, apellidos, correo, pass, rol, archivo_nombre, archivo_file)
            VALUES ('$nombre', '$apellidos', '$correo', '$pass_encriptada', $rol, '$nombre_archivo', '$nombre_archivo_enc')";

    $res = $con->query($sql);
    header("Location: empleados_lista.php");  
?>