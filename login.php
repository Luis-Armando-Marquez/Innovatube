<!-- CONEXION_BASE_DATOS -->
 <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "innovatube";

    $conn = new mysqli($host, $user, $password, $dbname);
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
                  <li class="Header_nav_ul"><a href="login.php">Login</a></li>
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
                        <th colspan="1"><img src="Castor.png" alt=""></th>
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
                        <th><label class="Registro_label" for="Recuperar_contraseña">Recuperar contraseña </label></th>
                    </tr>
                    <tr>
                        <th colspan="1"><input type="submit" name="Iniciar"></th>
                    </tr>
                </tbody>
             </table>
        </form>
    </section>
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
                echo "<p>Bienvenido " . htmlspecialchars($fila['Usuario_innova']) . "</p>";
            } else {
                echo "<p>Contraseña incorrecta</p>";
            }
            } else {
                echo "<p>Usuario o correo incorrecto</p>";
            }
            
            $stmt->close();
            $conn->close();

            }
    ?>
</body>
</html>