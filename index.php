<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleToCalendar</title>

</head>
<body>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
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

    
    <script>
        const urlApiCalendar = "https://www.googleapis.com/calendar/v3";
        function onSignIn(googleUser) {
            const endpointListCalendar = "/users/me/calendarList";
            let endpoint = urlApiCalendar + endpointListCalendar;
            
            fetch(endpoint, {
                method: "GET",
                headers: {
                    'Authorization' : "Bearer " + googleUser,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.log(error));
        }
    </script>

</body>
</html>
