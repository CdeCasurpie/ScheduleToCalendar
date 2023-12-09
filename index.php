<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleToCalendar</title>
</head>
<body>
    <!-- checkear si tiene login de google -->
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
        }
    </script>
</body>
</html>
