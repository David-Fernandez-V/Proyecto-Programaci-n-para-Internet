<?php
    require "../funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    //$sql = "DELETE FROM empleados WHERE id = $id";
    $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";
    $res = $con->query($sql);

    if ($res) {
        echo "success";
    } else {
        echo "error";
    }
?>