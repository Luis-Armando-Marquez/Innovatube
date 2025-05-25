<?php
    session_start();
    
    $host = "mysql.railway.internal";
    $user = "root";
    $password = "KbONkCiRyJLhJYIdvzUVekyMXKYOMvhA";
    $dbname = "railway";
    $port = 3306;

    $conn = new mysqli($host, $user, $password, $dbname, $port);

    if (isset($_POST['Verificar'])) {
        $Nombre_innova = $_POST['Nombre_usuario'];
        $Usuario_innova = $_POST['Username'];
        $Email_innova = $_POST['Email_usuario'];

        $stmt = $conn->prepare("SELECT * FROM usuarios_innovatube WHERE Nombre_innova=? AND Usuario_innova=? AND Email_innova=?");
        $stmt->bind_param("sss", $Nombre_innova, $Usuario_innova, $Email_innova);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $_SESSION['Usuario_recuperar'] = $Usuario_innova;
            header("Location: modificar_pass.php");
            exit();
        } else {
            //echo "<p style='color:red;'>Datos incorrectos</p>";
        }
    }
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
                  <li class="Header_nav_ul"><a href="index.php">Salir</a></li>
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
                        <th><label class="Recuperar_label" for="Nombre_apellido">Nombre y apellido: </label></th>
                        <th><input class="Recuperar_input" type="text" id="Nombre_usuario" name="Nombre_usuario" required placeholder="Astrid Carrasco"></th>
                    </tr>
                    <tr>
                        <th><label class="Recuperar_label" for="Nombre_usuario">Nombre de usuario: </label></th>
                        <th><input class="Recuperar_input" type="text" id="Username" name="Username" required placeholder="Astrid12"></th>
                    </tr>
                    <tr>
                        <th><label class="Recuperar_label" for="Email_usuario">Correo electronico: </label></th>
                        <th><input class="Recuperar_input" type="text" id="Email_usuario" name="Email_usuario" required placeholder="Astrid.carrasco@outlook.com"></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit" name="Verificar" value="Verificar identidad"></th>
                    </tr>
                </tbody>
             </table>
        </form>
    </section>
</body>
</html>