<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //form data, credential y g_csrf_token
    $credential = $_POST["credential"];
    $g_csrf_token = $_POST["g_csrf_token"];

    //verificar el g_csrf_token con el que está en la cookie actual
    if ($g_csrf_token != $_COOKIE["g_csrf_token"]) {
        // retornar a la pagina principal y borrar la cookie
        setcookie("credential", "", time() - 3600, "/");
        setcookie("g_csrf_token", "", time() - 3600, "/");
        header("Location: /");
    }

    // crear una cookie con el credential
    setcookie("credential", $credential, time() + (86400 * 30), "/");
    // retornar a la pagina principal
    header("Location: /");
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // mostrar la pagina de login que esta en login.html
    include "login.html";
}
?>