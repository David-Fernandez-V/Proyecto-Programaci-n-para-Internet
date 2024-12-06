<?php
    session_start();

    if (isset($_SESSION['nombre'])) {
        header("Location: bienvenido.php"); 
        exit();
    }
?>

<html>
<head>
    <title>Login</title>
    
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    <script src="../js/jquery-3.3.1.min.js"></script>
    
    <script>
        function validar(){
            var correo = document.forma01.correo.value;
            var pass = document.forma01.pass.value;

            if(correo=='' || pass==''){
                $('#mensaje').show();
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
            }else{
                consultar_usuario(correo,pass);
            }
        }

        function consultar_usuario(correo,pass){
            $.ajax({
                url     :   '../funciones/valida_usuario.php',
                type    :   'post',
                data    :   {correo:correo,pass:pass},
                success :   function(res){
                    console.log(res);
                    if (res == 1) {
                        window.location.href = 'bienvenido.php';
                    }else{
                        $('#mensaje').show();
                        $('#mensaje').html('Datos incorrectos');
                        setTimeout("$('#mensaje').html(''); $('#mensaje').hide();", 5000);
                    }
                },error: function() {
                    $('#mensaje').html('Error al procesar la solicitud');
                }
            });
        }
    </script>

</head>
<body>
    <div id='contenedor_principal'>
        <div class='titulo'>Inicio de Sesión</div>
        <br><br><br>
        <div class="contenedor_centrar">
            <div class="contenedor_formulario">
                <form name='forma01' method='POST'>  
                    <input class='entrada_formulario' id='correo' name='correo' type='email' placeholder='Ingresar correo'>
                    <input class='entrada_formulario' id='pass' name='pass' type='text' placeholder='Ingresar contraseña'><br>
                    <br><input class='boton' onClick='validar(); return false;' type='submit' value='Login'><br>
                    <br><div id='mensaje' class='mensaje'></div>
                </form>
            </div>
        </div>
        <br>
    </div>
</body>
</html>