<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // mostrar la pagina de login que esta en login.html
    include "login.html";
} else {
    echo "Error: Invalid request method";
}
?>