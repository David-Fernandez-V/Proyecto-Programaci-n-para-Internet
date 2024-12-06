<?php
    session_start();
    require "conecta.php";
    $con = conecta();

    $correo = $_REQUEST['correo'];
    $pass = $_REQUEST['pass'];
    $pass_encriptada = md5($pass);

    $sql = "SELECT * FROM empleados WHERE correo = '$correo' AND pass='$pass_encriptada'
            AND status=1 AND eliminado=0";

    $res = $con->query($sql);
    $num = $res->num_rows;

    if($num == 1){
        $row = $res->fetch_array();
        $id = $row['id'];
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
        $_SESSION['correo'] = $correo;
    }

    echo $num;
?>