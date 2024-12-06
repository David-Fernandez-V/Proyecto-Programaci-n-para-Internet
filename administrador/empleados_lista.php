<?php
    session_start();
    $nombre = $_SESSION['nombre'];

    if (!isset($_SESSION['nombre'])) {
        header("Location: index.php"); 
        exit();
    }
?>

<html>
<head>
    <title>Lista de empleados</title>
    
    <?php
    require "../funciones/conecta.php";
    $con = conecta();

    $sql = "SELECT * FROM empleados WHERE eliminado = 0";
    $res = $con->query($sql);
    $num = $res->num_rows;
    ?>
    
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">

    <script src="../js/jquery-3.3.1.min.js"></script>
    
    <script>
        function eliminar_empleado(id){
            if(window.confirm("¿Deseas eliminar este usuario?")){
                $.ajax({
                    url     :   'empleados_elimina.php',
                    type    :   'post',
                    data    :   {id:id},
                    success :   function(res){
                        if (res.trim() == "success") {
                            $("#empleado" + id).remove();
                            $('#mensaje').html('Empleado eliminado correctamente');
                            setTimeout("$('#mensaje').html('');",3000);
                        } else {
                            $('#mensaje').html('Error al eliminar empleado');
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
        <div class='titulo'>Sección D05. Lista de empleados: (<?php echo $num; ?>)</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='empleados_alta.php'>Dar de alta nuevo empleado</a></div><br>
        <div class='tabla'>
            <div class='fila encabezado'>
                <div class='celda'>ID</div>
                <div class='celda'>Nombre</div>
                <div class='celda'>Correo</div>
                <div class='celda'>Rol</div>
                <div class='celda'></div>
                <div class='celda'></div>
                <div class='celda'></div>
            </div>

            <?php
            $roles = [
                "1" => "Gerente",
                "2" => "Ejecutivo"
            ];

            while ($row = $res->fetch_array()) {
                $id = $row["id"];
                $nombre = $row["nombre"];
                $apellidos = $row["apellidos"];
                $correo = $row["correo"];
                $indice_rol = $row["rol"];
                $rol = $roles[$indice_rol];
                $eliminar = $row["eliminado"];

                echo "<div id='empleado$id' class='fila'>";
                echo "<div class='celda'>$id</div>";
                echo "<div class='celda'>$nombre $apellidos</div>";
                echo "<div class='celda'>$correo</div>";  
                echo "<div class='celda'>$rol</div>";
                echo "<div class='celda'> <a href='#' onclick='eliminar_empleado(".$id.")'> Eliminar </a> </div>";
                echo "<div class='celda'> <a href='empleados_detalle.php?id=$id'> Ver detalle </a> </div>";
                echo "<div class='celda'> <a href='empleados_edita.php?id=$id'> Editar </a> </div>";
                echo "</div>";
            }
            ?>
        </div>
        <br>
        <div id='mensaje' class='mensaje'></div>
    </div>
</body>
</html>
