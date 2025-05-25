<?php
    session_start();
    if (!isset($_SESSION['Usuario_innova'])){
        header("Location: index.php");
        exit();
    }

    //CONEXION A DB
    $host = "mysql.railway.internal";
    $user = "root";
    $password = "KbONkCiRyJLhJYIdvzUVekyMXKYOMvhA";
    $dbname = "railway";
    $port = 3306;

    $conn = new mysqli($host, $user, $password, $dbname, $port);
?>
<!-- END_DB -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnovaTube</title>
    <link rel="stylesheet" href="style_navegacion.css">
</head>
<body>
    <!-- HEADER -->
    <header class="Header">
        <div class="Header_div">
            <a href="#"><img src="Castor.png" class="Header_logo"></a>
            <!-- ENLACES -->
            <nav class="Header_nav">
                <ul class="Header_nav_ul">
                  <li class="Header_nav_ul">Bienvenido, <?php echo htmlspecialchars($_SESSION['Usuario_innova']); ?></li>
                  <li class="Header_nav_ul"><a href="cerrar.php">Cerrar sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- END HEADER -->
</body>
</html>