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

    $sql = "SELECT * FROM promociones WHERE id = $id";
    $res = $con->query($sql);
    $num = $res->num_rows;

    $promocion_encnotrada = true;

    $estados = [
        "0" => "Inactivo",
        "1" => "Activo"
    ];

    if($num>0){
        $row = $res->fetch_assoc();
        $nombre = $row["nombre"];
        $indice_status = $row["status"];
        $status = $estados[$indice_status];
        $eliminado = $row["eliminado"];
        $foto = $row["archivo"];

        if($eliminado == 1){
            $promocion_encnotrada = false;
        }
    }else{
        $promocion_encnotrada = false;
    }
?>

<html>
<head>
    <title>Detalle de promoción</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Detalle de promoción.</div>
        <?php
            include "menu.php";
        ?>
            <a href='promociones_lista.php'>Regresar al listado</a><br><br>
            <div class="fila encabezado"><div class="celda"> Detalles de la promoción. ID : <?php echo $id;?></div></div>
            <?php if ($promocion_encnotrada): ?>
                <div class='fila'><div class='celda'><img <?php echo"src='archivos/$foto'"?> class="imagen"></div></div>
                <div class='fila'><div class='celda'>Nombre: <?php echo"$nombre";?></div></div>
                <div class='fila'><div class='celda'>Estado: <?php echo"$status";?></div></div>
            <?php else: ?>
                <br><div id='mensaje' class='mensaje'>No existe producto con el id proporcionado</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>