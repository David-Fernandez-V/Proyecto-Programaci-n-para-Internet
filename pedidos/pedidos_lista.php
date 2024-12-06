<?php
    session_start();
    $nombre = $_SESSION['nombre'];

    if (!isset($_SESSION['nombre'])) {
        header("Location: ../administrador/index.php"); 
        exit();
    }
?>

<html>
<head>
    <title>Lista de pedidos</title>
    
    <?php
        require "../funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM pedidos WHERE status = 1";
        $res = $con->query($sql);
        $num = $res->num_rows;
    ?>
    
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">

    <script src="../js/jquery-3.3.1.min.js"></script>
    
    <script>
            
    </script>

</head>
<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Lista de Pedidos: (<?php echo $num; ?>)</div>
        <?php
            include "menu.php";
        ?>
        <div class='tabla'>
            <div class='fila encabezado'>
                <div class='celda'>ID</div>
                <div class='celda'>Fecha</div>
                <div class='celda'>Usuario</div>
                <div class='celda'></div>
            </div>

            <?php
            while ($row = $res->fetch_array()) {
                $id = $row["id"];
                $fecha = $row["fecha"];
                $id_usuario = $row["id_usuario"];

                $sql = "SELECT * FROM clientes WHERE id = $id_usuario";
                $res_cliente = $con->query($sql); 
                $cliente = $res_cliente->fetch_assoc();
                $nombre_cliente = $cliente["nombre"];

                echo "<div id='producto$id' class='fila'>";
                echo "<div class='celda'>$id</div>";
                echo "<div class='celda'>$fecha</div>";
                echo "<div class='celda'>$nombre_cliente</div>";  
                echo "<div class='celda'> <a href='pedidos_detalle.php?id=$id'> Ver detalle </a> </div>";
                echo "</div>";
            }
            ?>
        </div>
        <br>
        <div id='mensaje' class='mensaje'></div>
    </div>
</body>
</html>