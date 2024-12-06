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
    <title>Alta de nueva promoción</title>

    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>
        function validar(){
            var nombre = document.forma01.nombre.value;
            var archivo = document.forma01.foto.value;

            if(nombre=='' || archivo.length==0){
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
        <div class='titulo'>Sección D05. Alta de nueva promoción.</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='promociones_lista.php'>Regresar al listado</a></div><br>
        <div class='contenedor_formulario'>
            <form name='forma01' enctype="multipart/form-data" action='promociones_salva.php' method='POST'>
                <input class='entrada_formulario' id='nombre' name='nombre' type='text' placeholder='Ingresar producto'><br>
                <div class="agrupador">
                    <label class="entrada_formulario">Elegir foto.<br></label><input class="entrada_formulario" type="file" id="foto" name="foto">
                </div>  
                <br><input class='boton' onClick='if(!validar()){return false;}' type='submit' value='Crear promoción'><br>
                <br><div id='mensaje' class='mensaje'></div>
            </form>
        </div>
    </div>
</body>

</html>