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

    $sql = "SELECT * FROM pedidos WHERE id = $id";
    $res = $con->query($sql);
    $num = $res->num_rows;

    $pedido_encnotrado = true;

    $estados = [
        "0" => "Abierto",
        "1" => "Cerrado"
    ];

    if($num>0){
        $row = $res->fetch_assoc();
        $fecha = $row["fecha"];
        $id_usuario = $row["id_usuario"];
        $status = $row["status"];

        $sql = "SELECT * FROM clientes WHERE id = $id_usuario";
        $res_cliente = $con->query($sql); 
        $cliente = $res_cliente->fetch_assoc();
        $nombre_cliente = $cliente["nombre"];


        if($status == 0){
            $pedido_encnotrado = false;
        }
    }else{
        $pedido_encnotrado = false;
    }

    if($pedido_encnotrado){
        $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id";
        $res = $con->query($sql);
        $num = $res->num_rows;
    }
?>

<html>
<head>
    <title>Detalle de pedido</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Detalle del pedido.</div>
        <?php
            include "menu.php";
        ?>
            <a href='pedidos_lista.php'>Regresar al listado</a><br><br><br>


            <div class="subtitulo"> Detalles del pedido. ID : <?php echo $id;?> </div>
            <?php if ($pedido_encnotrado): ?>
                <div class="fila encabezado"><div class="celda">Fecha: <?php echo $fecha;?></div></div>
                <div class="fila encabezado"><div class="celda">Cliente: <?php echo $nombre_cliente;?></div></div>

                <div class="tabla">
                    <div class="fila encabezado">
                        <div class='celda'>ID producto</div>
                        <div class='celda'>Producto</div>
                        <div class='celda'>Cantidad</div>
                        <div class='celda'>Precio</div>
                        <div class='celda'>Subtotal</div>
                    </div>

                    <?php
                    $total = 0;
                    while ($row = $res->fetch_array()) {
                        $id_producto = $row["id_producto"];
                        $cantidad = $row["cantidad"];
                        $precio = $row["precio"];
                        $subtotal = $cantidad*$precio;

                        $sql = "SELECT * FROM productos WHERE id = $id_producto";
                        $resProducto = $con->query($sql);
                        $producto = $resProducto->fetch_assoc();
                        $nombre_producto = $producto["nombre"];


                        $total += $subtotal;

                        echo "<div class='fila'>";
                        echo "<div class='celda'>$id_producto</div>";
                        echo "<div class='celda'>$nombre_producto</div>";
                        echo "<div class='celda'>$cantidad</div>";
                        echo "<div class='celda'>$precio</div>";  
                        echo "<div class='celda'>$subtotal</div>";
                        echo "</div>";
                    }

                    echo "<div class='fila'>";
                    echo "<div class='celda'></div>";
                    echo "<div class='celda'></div>";
                    echo "<div class='celda'></div>";
                    echo "<div class='celda_resaltada'>Total: </div>";
                    echo "<div class='celda_resaltada'>$total</div>";
                    echo "</div>";
                    ?>

                </div>
            <?php else: ?>
                <br><div id='mensaje' class='mensaje'>No existe pedido con el id proporcionado</div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>