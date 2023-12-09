<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleToCalendar</title>
    <script src="functions.js"></script>
    <script>
        // check cookies
        if (!getCookie("token")) {
            window.location.href = "login.php";
        }

        // logout
        function logout() {
            deleteCookie("token");
            window.location.href = "login.php";
        }
    </script>
</head>
<body>
    <h1>ScheduleToCalendar</h1>
    <textArea id="schedule" rows="10" cols="50"></textArea>

    <button onclick="logout()">Logout</button>
</body>
</html>
