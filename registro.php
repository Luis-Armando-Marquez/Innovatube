<!-- CONEXION_BASE_DATOS -->
 <?php
    /*
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "innovatube";
    */

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style_registro.css">
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
    <section class="Registro">
        <form class="Registro_formulario" method="POST">
            <table class="Registro_tabla">
                <thead>
                    <tr>
                        <th colspan="2">REGISTRO DE USUARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><label class="Registro_label" for="Nombre_apellido">Nombre y apellido: </label></th>
                        <th><input class="Registro_input" type="text" id="Nombre_usuario" name="Nombre_usuario" required placeholder="Astrid Carrasco"></th>
                    </tr>
                    <tr>
                        <th><label class="Registro_label" for="Nombre_usuario">Nombre de usuario: </label></th>
                        <th><input class="Registro_input" type="text" id="Username" name="Username" required placeholder="Astrid12"></th>
                    </tr>
                    <tr>
                        <th><label class="Registro_label" for="Email_usuario">Correo electronico: </label></th>
                        <th><input class="Registro_input" type="text" id="Email_usuario" name="Email_usuario" required placeholder="Astrid.carrasco@outlook.com"></th>
                    </tr>
                    <tr>
                        <th><label class="Registro_label" for="Contraseña_usuario">Contraseña: </label></th>
                        <th><input class="Registro_input" type="password" id="Contraseña_usuario" name="Contraseña_usuario" required placeholder="12345"></th>
                    </tr>
                    <tr>
                        <th><label class="Registro_label" for="Confirmar_usuario">Confirmar contraseña: </label></th>
                        <th><input class="Registro_input" type="password" id="Confirmar_contraseña" name="Confirmar_contraseña" required placeholder="12345"></th>
                    </tr>
                    <tr>
                        <th colspan="2"><div class="g-recaptcha" data-sitekey="6Ld8F0crAAAAAF7FKpf7Spyr1FhX3AQeoYGx5b5b"></div></th>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit" name="Registrar" value="Registrar usuario"></th>
                    </tr>
                </tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $secret = "6Ld8F0crAAAAAIzTmYON81EdQufZH7QWqsWRe5PS";
                    $response = $_POST["g-recaptcha-response"];
                    $remoteip = $_SERVER["REMOTE_ADDR"];

                    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
                    $captcha_success = json_decode($verify);

                    if ($captcha_success->success) {
                    echo "<p style='color: green;'>Verificación correcta</p>";
                    
                    if(isset($_POST['Registrar'])){
                    $Nombre_innova = $_POST['Nombre_usuario'];
                    $Usuario_innova = $_POST['Username'];
                    $Email_innova = $_POST['Email_usuario'];
                    $Password_innova = $_POST['Contraseña_usuario'];
                    $Confirmar_innova = $_POST['Confirmar_contraseña'];
                    
                    if ($Password_innova !== $Confirmar_innova){
                        echo "<p style='color: red;'>Error, las contraseñas no coinciden</p>";
                    } else {
                        $Password_innova = password_hash($_POST['Contraseña_usuario'], PASSWORD_DEFAULT);
                        //$Password_innova = password_hash($Password_innova, PASSWORD_DEFAULT);

                        $Insertar = "INSERT INTO usuarios_innovatube (Nombre_innova, Usuario_innova, Email_innova, Password_innova) VALUES ('$Nombre_innova', '$Usuario_innova', 
                        '$Email_innova', '$Password_innova')";

                        if ($conn->query($Insertar) === TRUE) {
                        echo "<p style='color: green;'>Registro exitoso</p>";
                        } else {
                            echo "Error al registrar: " . $conn->error;
                        }
                    }
                }

                    }
                    else {
                        echo "<p style='color: red;'>Error, verificación fallida</p>";
                    }
                }
            ?>

             </table>
        </form>
    </section>
</body>
</html>