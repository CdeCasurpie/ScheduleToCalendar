<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "POST- login page";
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "GET- login page";
}
?>