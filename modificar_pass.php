<!-- CONEXION_BASE_DATOS -->
 <?php
    session_start();
    if (!isset($_SESSION['Usuario_recuperar'])) {
        header("Location: recuperar.php");
        exit();
    }

$Usuario = $_SESSION['Usuario_recuperar'];

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style_recuperar.css">
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
                  <li class="Header_nav_ul"><a href="login.php">Salir</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- END HEADER -->
    <!-- FORMULARIO -->
    <section class="Recuperar">
        <form class="Recuperar_formulario" method="POST">
            <table class="Recuperar_tabla">
                <thead>
                    <tr>
                        <th colspan="2">RECUPERAR CONTRASEÑA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><label class="Recuperar_label" for="Nueva_pass">Nueva contraseña: </label></th>
                        <th><input class="Recuperar_input" type="password" id="Nueva_pass" name="Nueva_pass" required placeholder="12345"></th>
                    </tr>
                    <tr>
                        <th><label class="Recuperar_label" for="Confirmar_pass">Confirmar contraseña: </label></th>
                        <th><input class="Recuperar_input" type="password" id="Confirmar_pass" name="Confirmar_pass" required placeholder="12345"></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit" name="Cambiar" value="Cambiar contraseña"></th>
                    </tr>
                    <?php
                    if (isset($_POST['Cambiar'])) {
                        $Nueva = $_POST['Nueva_pass'];
                        $Confirmar = $_POST['Confirmar_pass'];

                        if ($Nueva !== $Confirmar) {
                            echo "<p style='color:red;'>No coinciden las contraseñas</p>";
                        } else {
                            $nuevaHash = password_hash($Nueva, PASSWORD_DEFAULT);

                            $stmt = $conn->prepare("UPDATE usuarios_innovatube SET Password_innova=? WHERE Usuario_innova=?");
                            $stmt->bind_param("ss", $nuevaHash, $Usuario);
                            if ($stmt->execute()) {
                                echo "<p style='color:green;'>Contraseña actualizada</p>";
                                session_destroy();
                            } else {
                                echo "<p style='color:red;'>Error, No se puede cambiar</p>";
                            }
                        }
                    }
                    ?>
                </tbody>
             </table>
        </form>
    </section>
</body>
</html>