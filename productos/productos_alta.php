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
    <title>Alta de nuevo producto</title>

    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>
        var codigo_disponible = false;

        function validar(){
            var nombre = document.forma01.nombre.value;
            var codigo = document.forma01.codigo.value;
            var descripcion = document.forma01.descripcion.value;
            var stock = document.forma01.stock.value;
            var costo = document.forma01.costo.value;
            var archivo = document.forma01.foto.value;

            if(nombre=='' || codigo=='' || descripcion=='' || stock==0 || costo==0 || archivo.length==0){
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            }else{
                if(codigo_disponible){
                    return true;
                }else{
                    $('#mensaje').show();
                    $('#mensaje').html('Código no disponible');
                    setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                    return false;
                }
            }
        }

        function verificar_codigo(){
            var codigo = document.forma01.codigo.value;
            $.ajax({
                url     : '../funciones/codigo_verifica.php',
                type    : 'post',
                data    : {codigo:codigo},
                success : function(res){
                    console.log('Respuesta del servidor:', res);
                    if(res.trim() == 'unavailable'){
                        codigo_disponible = false;
                        $('#mensaje2').show();
                        $('#mensaje2').html('El código '+codigo+' ya existe.');
                        setTimeout("$('#mensaje2').html(''); $('#mensaje2').hide();", 5000);
                    }else{
                        console.log('codigo '+codigo+' disponible');
                        codigo_disponible = true;
                    }
                },error : function(){
                    $('#mensaje2').html('Error al procesar la solicitud');
                }
            })
        }
    </script>
</head>

<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Sección D05. Alta de nuevo producto.</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='productos_lista.php'>Regresar al listado</a></div><br>
        <div class='contenedor_formulario'>
            <form name='forma01' enctype="multipart/form-data" action='productos_salva.php' method='POST'>
                <input class='entrada_formulario' id='nombre' name='nombre' type='text' placeholder='Ingresar producto'><br>
                <input class='entrada_formulario' id='codigo' name='codigo' type='text' placeholder='Ingresar codigo' onblur='verificar_codigo();'><br>
                <div id='mensaje2' class='mensaje'></div>
                <textarea class='entrada_formulario' id='descripcion' name='descripcion'  rows="5" placeholder='Descripción del producto'></textarea><br>
                <input class='entrada_formulario' id='stock' name='stock' type='number' placeholder='Ingresar stock'><br>      
                <input class='entrada_formulario' id='costo' name='costo' type='number' min="0" step="0.01" placeholder='Ingresar precio'><br>      
                <div class="agrupador">
                    <label class="entrada_formulario">Elegir foto.<br></label><input class="entrada_formulario" type="file" id="foto" name="foto">
                </div>  
                <br><input class='boton' onClick='if(!validar()){return false;}' type='submit' value='Crear producto'><br>
                <br><div id='mensaje' class='mensaje'></div>
            </form>
        </div>
    </div>
</body>

</html>