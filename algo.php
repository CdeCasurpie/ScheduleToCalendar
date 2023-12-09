<?php
// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Hola";
} else {
    echo "Error: Esta página solo acepta solicitudes POST.";
}
?>