<?php
    require "../funciones/conecta.php";
    $con = conecta();
    $codigo = $_REQUEST['codigo'];

    $sql = "SELECT * FROM productos WHERE codigo = '$codigo'";
    $res = $con->query($sql);

    if ($res->num_rows > 0) {
        echo "unavailable";
    } else {
        echo "available";
    }
?> 