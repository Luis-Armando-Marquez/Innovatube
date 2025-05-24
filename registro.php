<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnovaTube</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
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
                        <th colspan="2"><input type="submit" name="Registrar"></th>
                    </tr>
                </tbody>
             </table>
        </form>
    </section>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $secret = "6Ld8F0crAAAAAIzTmYON81EdQufZH7QWqsWRe5PS";
            $response = $_POST["g-recaptcha-response"];
            $remoteip = $_SERVER["REMOTE_ADDR"];

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
            $captcha_success = json_decode($verify);

            if ($captcha_success->success) {
            echo "<p>Verificación correcta</p>";
            }
            else {
                echo "<p style='color: red;'>Error, verificación fallida</p>";
            }
        }
    ?>
</body>
</html>