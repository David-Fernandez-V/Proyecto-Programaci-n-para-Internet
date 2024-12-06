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

    $promocion_encontrada = true;

    if($num>0){
        $row = $res->fetch_assoc();
        $nombre = $row['nombre'];
        $status = $row["status"];
        $eliminado = $row["eliminado"];

        if($eliminado == 1){
            $promocion_encontrada = false;
        }
    }else{
        $promocion_encontrada = false;
    }
?>

<html>
<head>
    <title>Edición de promoción</title>

    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>
        function validar(){
            var nombre = document.forma01.nombre.value;
            if(nombre==''){
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            }else{
                return true;
            }
        }
    </script>

</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Edición de promoción.</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='promociones_lista.php'>Regresar al listado</a></div><br>

        <?php if ($promocion_encontrada): ?>
            <div class='contenedor_formulario'>
                <form name='forma01' enctype="multipart/form-data" action='promociones_actualiza.php' method='POST'>
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <input class='entrada_formulario' id='nombre' name='nombre' type='text' placeholder='Ingresar producto' value='<?php echo $nombre; ?>'><br>
                    <div class="agrupador">
                        <label class="entrada_formulario">Elegir foto.<br></label><input class="entrada_formulario" type="file" id="foto" name="foto">
                    </div>  
                    <br><input class='boton' onClick='if(!validar()){return false;}' type='submit' value='Actualizar producto'><br>
                    <br><div id='mensaje' class='mensaje'></div>
                </form>
            </div>
        <?php else: ?>
            <br><div id='mensaje' class='mensaje'>No existe empleado con el id proporcionado</div>
        <?php endif; ?>
    </div>
</body>

</html>