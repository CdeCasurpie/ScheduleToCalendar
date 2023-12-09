<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScheduleToCalendar</title>

</head>
<body>
    <script src="https://accounts.google.com/gsi/client" onload="console.log('TODO: add onload function')"></script>

    <script>
        const urlApiCalendar = "https://www.googleapis.com/calendar/v3";
        const client = google.accounts.oauth2.initTokenClient({
            client_id: '796952607356-gsj82osa6j1r7j88vca6ru08q9r5ncda.apps.googleusercontent.com',
            scope: 'https://www.googleapis.com/auth/calendar.readonly',
            callback: (tokenResponse) => {
                console.log(tokenResponse);
            },
        });
    </script>

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


</body>
</html>
