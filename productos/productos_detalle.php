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

    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = $con->query($sql);
    $num = $res->num_rows;

    $producto_encnotrado = true;

    $estados = [
        "0" => "Inactivo",
        "1" => "Activo"
    ];

    if($num>0){
        $row = $res->fetch_assoc();
        $nombre = $row["nombre"];
        $codigo = $row["codigo"];
        $descripcion = $row["descripcion"];
        $costo = $row["costo"];
        $stock = $row["stock"];
        $indice_status = $row["status"];
        $status = $estados[$indice_status];
        $eliminado = $row["eliminado"];
        $foto = $row["archivo"];

        if($eliminado == 1){
            $producto_encnotrado = false;
        }
    }else{
        $producto_encnotrado = false;
    }
?>

<html>
<head>
    <title>Detalle de producto</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Detalle de producto.</div>
        <?php
            include "menu.php";
        ?>
            <a href='productos_lista.php'>Regresar al listado</a><br><br>
            <div class="fila encabezado"><div class="celda"> Detalles del producto. ID : <?php echo $id;?></div></div>
            <?php if ($producto_encnotrado): ?>
                <div class='fila'><div class='celda'><img <?php echo"src='archivos/$foto'"?> class="imagen"></div></div>
                <div class='fila'><div class='celda'>Nombre: <?php echo"$nombre";?></div></div>
                <div class='fila'><div class='celda'>Codigo: <?php echo"$codigo";?></div></div>
                <div class='fila'><div class='celda'>Descripcion: <?php echo"$descripcion";?></div></div>
                <div class='fila'><div class='celda'>Costo: <?php echo"$costo";?> $</div></div>
                <div class='fila'><div class='celda'>Stock: <?php echo"$stock";?> unidades</div></div>
                <div class='fila'><div class='celda'>Estado: <?php echo"$status";?></div></div>
            <?php else: ?>
                <br><div id='mensaje' class='mensaje'>No existe producto con el id proporcionado</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>