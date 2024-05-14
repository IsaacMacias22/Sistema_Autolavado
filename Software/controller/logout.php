<?php
// Inicia la sesión si aún no ha sido iniciada
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header("Location: login");
exit;
?>