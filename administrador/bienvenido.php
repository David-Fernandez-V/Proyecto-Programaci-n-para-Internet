<?php
    session_start();
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];

    if (!isset($_SESSION['nombre'])) {
        header("Location: index.php"); 
        exit();
    }
?>

<html>
    <head>
        <title>Bienvenida</title>
        <link rel="stylesheet" href="../css/style.css?v=<?php echo time();?>">
    </head>

    <body>
        <div id='contenedor_principal'>
            <div class='titulo'>Bienvenido <?php echo $nombre.' '.$apellidos;?></div>
            <br>
            <?php
                include "menu.php";
            ?>
        </div>
    </body>
</html>