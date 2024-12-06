<?php
    require "../funciones/conecta.php";
    $con = conecta();
    $correo = $_REQUEST['correo'];

    $sql = "SELECT * FROM empleados WHERE correo = '$correo'";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        echo "unavailable";
    } else {
        echo "available";
    }
?> 