<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleToCalendar</title>

</head>
<body>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <h1 id="nombre-usuario">Nombre de Usuario</h1>

    <script>
        function onSignIn(googleUser) {
            // Obtener la información del perfil del usuario
            var profile = googleUser.getBasicProfile();

            // Mostrar el nombre del usuario en un elemento HTML
            document.getElementById('nombre-usuario').textContent = '¡Hola, ' + profile.getName() + '!';
        }
    </script>

    <script>
        function getCookie(name) {
            var cookieArr = document.cookie.split(";");

            for (var i = 0; i < cookieArr.length; i++) {
                var cookiePair = cookieArr[i].split("=");

                if (name == cookiePair[0].trim()) {
                    return decodeURIComponent(cookiePair[1]);
                }
            }
            return null;
        }

        let token = getCookie("credential");
        if (token == null) {
            window.location.href = "/login.php";
        } else {
            onSignIn(token);
        }
    </script>
</body>
</html>
