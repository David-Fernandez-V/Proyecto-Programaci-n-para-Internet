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
    <title>Alta de nuevo empleado</title>

    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    <script src="../js/jquery-3.3.1.min.js"></script>

    <script>
        var correo_disponible = false;

        function validar(){
            var nombre = document.forma01.nombre.value;
            var apellidos = document.forma01.apellidos.value;
            var correo = document.forma01.correo.value;
            var pass = document.forma01.pass.value;
            var rol = document.forma01.rol.selectedIndex;
            var archivo = document.forma01.foto.files;

            if(nombre=='' || apellidos=='' || correo=='' || pass=='' || rol==0 || archivo.length==0){
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                return false;
            }else{
                if(correo_disponible){
                    return true;
                }else{
                    $('#mensaje').show();
                    $('#mensaje').html('Correo no disponible');
                    setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                    return false;
                }
            }
        }

        function verificar_correo(){
            var correo = document.forma01.correo.value;
            $.ajax({
                url     : '../funciones/correo_verifica.php',
                type    : 'post',
                data    : {correo:correo},
                success : function(res){
                    console.log('Respuesta del servidor:', res);
                    if(res.trim() == 'unavailable'){
                        correo_disponible = false;
                        $('#mensaje2').show();
                        $('#mensaje2').html('El correo '+correo+' ya existe.');
                        setTimeout("$('#mensaje2').html(''); $('#mensaje2').hide();", 5000);
                    }else{
                        console.log('correo '+correo+' disponible');
                        correo_disponible = true;
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
        <div class='titulo'>Sección D05. Alta de nuevo empleado.</div>
        <?php
            include "menu.php";
        ?>
        <div><a href='empleados_lista.php'>Regresar al listado</a></div><br>
        <div class='contenedor_formulario'>
            <form name='forma01' enctype="multipart/form-data" action='empleados_salva.php' method='POST'>
                <input class='entrada_formulario' id='nombre' name='nombre' type='text' placeholder='Ingresar nombre(s)'><br>
                <input class='entrada_formulario' id='apellidos' name='apellidos' type='text' placeholder='Ingresar apellidos'><br>    
                <select class='entrada_formulario' id='rol' name='rol'>
                    <option value='0' selected>Seleccionar rol</option>
                    <option value='1'>Gerente</option>
                    <option value='2'>Ejecutivo</option>			
                </select>
                <div class="agrupador">
                    <label class="entrada_formulario">Elegir foto.<br></label><input class="entrada_formulario" type="file" id="foto" name="foto">
                </div>  
                <input class='entrada_formulario' id='correo' name='correo' type='email' placeholder='Ingresar correo' onblur='verificar_correo();'>
                <div id='mensaje2' class='mensaje'></div>
                <input class='entrada_formulario' id='pass' name='pass' type='text' placeholder='Ingresar contraseña'><br>
		        <br><input class='boton' onClick='if(!validar()){return false;}' type='submit' value='Crear empleado'><br>
                <br><div id='mensaje' class='mensaje'></div>
            </form>
        </div>
    </div>
</body>

</html>