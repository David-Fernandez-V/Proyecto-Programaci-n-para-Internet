<?php
    session_start();
    $nombre = $_SESSION['nombre'];

    if (!isset($_SESSION['nombre'])) {
        header("Location: index.php"); 
        exit();
    }
?>

<?php
    require "../funciones/conecta.php";
    $con = conecta();
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM empleados WHERE id = $id";
    $res = $con->query($sql);
    $num = $res->num_rows;

    $empleado_encnotrado = true;

    $roles = [
        "1" => "Gerente",
        "2" => "Ejecutivo"
    ];

    $estados = [
        "0" => "Inactivo",
        "1" => "Activo"
    ];

    if($num>0){
        $row = $res->fetch_assoc();
        $nombre = $row["nombre"];
        $apellidos = $row["apellidos"];
        $indice_rol = $row["rol"];
        $rol = $roles[$indice_rol];
        $correo = $row["correo"];
        $indice_status = $row["status"];
        $status = $estados[$indice_status];
        $eliminado = $row["eliminado"];
        $foto = $row["archivo_file"];

        if($eliminado == 1){
            $empleado_encnotrado = false;
        }
    }else{
        $empleado_encnotrado = false;
    }
?>

<html>
<head>
    <title>Detalle de empleado</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Detalle de empleado.</div>
        <?php
            include "menu.php";
        ?>
            <a href='empleados_lista.php'>Regresar al listado</a><br><br>
            <div class="fila encabezado"><div class="celda"> Detalles del empleado. ID : <?php echo $id;?></div></div>
            <?php if ($empleado_encnotrado): ?>
                <div class='fila'><div class='celda'><img <?php echo"src='archivos/$foto'"?> class="imagen"></div></div>
                <div class='fila'><div class='celda'>Nombre: <?php echo"$nombre $apellidos";?></div></div>
                <div class='fila'><div class='celda'>Correo: <?php echo"$correo";?></div></div>
                <div class='fila'><div class='celda'>Rol: <?php echo"$rol";?></div></div>
                <div class='fila'><div class='celda'>Estado: <?php echo"$status";?></div></div>
            <?php else: ?>
                <br><div id='mensaje' class='mensaje'>No existe empleado con el id proporcionado</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>