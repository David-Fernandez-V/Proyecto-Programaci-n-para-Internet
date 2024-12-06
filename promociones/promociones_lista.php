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
    <title>Lista de promociones</title>
    
    <?php
        require "../funciones/conecta.php";
        $con = conecta();

        $sql = "SELECT * FROM promociones WHERE eliminado = 0";
        $res = $con->query($sql);
        $num = $res->num_rows;
    ?>
    
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">

    <script src="../js/jquery-3.3.1.min.js"></script>
    
    <script>
        function eliminar_promocion(id){
            if(window.confirm("¿Deseas eliminar esta promocion?")){
                $.ajax({
                    url     :   'promociones_elimina.php',
                    type    :   'post',
                    data    :   {id:id},
                    success :   function(res){
                        if (res.trim() == "success") {
                            $("#promocion" + id).remove();
                            $('#mensaje').html('Promoción eliminada correctamente');
                            setTimeout("$('#mensaje').html('');",3000);
                        } else {
                            $('#mensaje').html('Error al eliminar promoción');
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
        <div class='titulo'>Sección D05. Lista de Promociones: (<?php echo $num; ?>)</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='promociones_alta.php'>Dar de alta nueva promoción</a></div><br>
        <div class='tabla'>
            <div class='fila encabezado'>
                <div class='celda'>ID</div>
                <div class='celda'>Nombre</div>
                <div class='celda'></div>
                <div class='celda'></div>
                <div class='celda'></div>
            </div>

            <?php
            while ($row = $res->fetch_array()) {
                $id = $row["id"];
                $nombre = $row["nombre"];

                echo "<div id='promocion$id' class='fila'>";
                echo "<div class='celda'>$id</div>";
                echo "<div class='celda'>$nombre</div>";
                echo "<div class='celda'> <a href='#' onclick='eliminar_promocion(".$id.")'> Eliminar </a> </div>";
                echo "<div class='celda'> <a href='promociones_detalle.php?id=$id'> Ver detalle </a> </div>";
                echo "<div class='celda'> <a href='promociones_edita.php?id=$id'> Editar </a> </div>";
                echo "</div>";
            }
            ?>
        </div>
        <br>
        <div id='mensaje' class='mensaje'></div>
    </div>
</body>
</html>