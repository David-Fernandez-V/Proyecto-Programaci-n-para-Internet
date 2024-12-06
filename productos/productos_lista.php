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
    <title>Lista de productos</title>
    
    <?php
        require "../funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        $res = $con->query($sql);
        $num = $res->num_rows;
    ?>
    
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">

    <script src="../js/jquery-3.3.1.min.js"></script>
    
    <script>
        function eliminar_producto(id){
            if(window.confirm("¿Deseas eliminar este producto?")){
                $.ajax({
                    url     :   'productos_elimina.php',
                    type    :   'post',
                    data    :   {id:id},
                    success :   function(res){
                        if (res.trim() == "success") {
                            $("#producto" + id).remove();
                            $('#mensaje').html('Producto eliminado correctamente');
                            setTimeout("$('#mensaje').html('');",3000);
                        } else {
                            $('#mensaje').html('Error al eliminar producto');
                        }
                    },error: function() {
                        $('#mensaje').html('Error al procesar la solicitud');
                    }
                });
            }
        }    
    </script>

</head>
<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Lista de Productos: (<?php echo $num; ?>)</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='productos_alta.php'>Dar de alta nuevo producto</a></div><br>
        <div class='tabla'>
            <div class='fila encabezado'>
                <div class='celda'>ID</div>
                <div class='celda'>Nombre</div>
                <div class='celda'>Código</div>
                <div class='celda'>Costo</div>
                <div class='celda'>Stock</div>
                <div class='celda'></div>
                <div class='celda'></div>
                <div class='celda'></div>
            </div>

            <?php
            while ($row = $res->fetch_array()) {
                $id = $row["id"];
                $nombre = $row["nombre"];
                $codigo = $row["codigo"];
                $costo = $row["costo"];
                $stock = $row["stock"];

                echo "<div id='producto$id' class='fila'>";
                echo "<div class='celda'>$id</div>";
                echo "<div class='celda'>$nombre</div>";
                echo "<div class='celda'>$codigo</div>";  
                echo "<div class='celda'>$costo$</div>";
                echo "<div class='celda'>$stock</div>";
                echo "<div class='celda'> <a href='#' onclick='eliminar_producto(".$id.")'> Eliminar </a> </div>";
                echo "<div class='celda'> <a href='productos_detalle.php?id=$id'> Ver detalle </a> </div>";
                echo "<div class='celda'> <a href='productos_edita.php?id=$id'> Editar </a> </div>";
                echo "</div>";
            }
            ?>
        </div>
        <br>
        <div id='mensaje' class='mensaje'></div>
    </div>
</body>
</html>