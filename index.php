<!-- CONEXION_BASE_DATOS -->
 <?php
    session_start();

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
    <link rel="stylesheet" href="style_inicio.css">
</head>
<body>
    <!-- HEADER -->
    <header class="Header">
        <div class="Header_div">
            <a href="#"><img src="Castor.png" class="Header_logo"></a>
            <!-- ENLACES -->
            <nav class="Header_nav">
                <ul class="Header_nav_ul">
                  <li class="Header_nav_ul"><a href="registro.php">Registro</a></li>
                  <li class="Header_nav_ul"><a href="index.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- END HEADER -->

    <!-- FORMULARIO -->
    <section class="Inicio">
        <form class="Inicio_formulario" method="POST">
            <table class="Inicio_tabla">
                <thead>
                    <tr>
                        <th colspan="1"><img src="Castor_logo.png" alt=""></th>
                    </tr>
                    <tr>
                        <th colspan="1">Inicio Sesión</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><label class="Inicio_label" for="Nombre_usuario">Nombre de usuario ó correo </label></th>
                    </tr>
                    <tr>
                        <th><input class="Registro_input" type="text" id="Nombre_usuario" name="Nombre_usuario" required placeholder="Astrid Carrasco"></th>
                    </tr>
                    <tr>
                        <th><label class="Registro_label" for="Contraseña_usuario">Contraseña </label></th>
                    </tr>
                    <tr>
                        <th><input class="Registro_input" type="password" id="Contraseña_usuario" name="Contraseña_usuario" required placeholder="12345"></th>
                    </tr>
                    <tr>
                        <th><a href="recuperar.php" style="color: white; text-decoration: underline;">Recuperar contraseña</a></th>
                    </tr>
                    <tr>
                        <th colspan="1"><input type="submit" name="Iniciar" value="Iniciar sesión" href="navegacion.php"></th>
                    </tr>
                </tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $Username = $_POST["Nombre_usuario"];
                    $Pass = $_POST["Contraseña_usuario"];

                    //COLSULTA_DB
                    $stmt = $conn->prepare("SELECT ID_innova, Usuario_innova, Email_innova, Password_innova FROM usuarios_innovatube WHERE Usuario_innova = ? OR Email_innova = ?");
                    $stmt->bind_param("ss", $Username, $Username);
                    $stmt->execute();
                    $consulta = $stmt->get_result();

                    if ($consulta->num_rows === 1) {
                    $fila = $consulta->fetch_assoc();
                    $Password_innova = $fila['Password_innova'];
                    
                    //COMPARAR CONTRASEÑA INGRESADA CON EL HASH
                    if (password_verify($Pass, $Password_innova)) {
                        $_SESSION['Usuario_innova'] = $fila['Usuario_innova'];

                        header("Location: navegacion.php");
                        exit;
                        //echo "<p style='color: green;'>Bienvenido " . htmlspecialchars($fila['Usuario_innova']) . "</p>";
                    } else {
                        echo "<p style='color: red;'>Contraseña incorrecta</p>";
                    }
                    } else {
                        echo "<p style='color: red;'>Usuario o correo incorrecto</p>";
                    }
                    
                    $stmt->close();
                    $conn->close();

                    }
                ?>
             </table>
        </form>
    </section>
</body>
</html>