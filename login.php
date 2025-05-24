<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InnovaTube</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <!-- FORMULARIO -->
    <section class="Inicio">
        <form class="Inicio_formulario" method="POST">
            <table class="Inicio_tabla">
                <thead>
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
                        <th colspan="1"><input type="submit" name="Registrar"></th>
                    </tr>
                </tbody>
             </table>
        </form>
    </section>
</body>
</html>