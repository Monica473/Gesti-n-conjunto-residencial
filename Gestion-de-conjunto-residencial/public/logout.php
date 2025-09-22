<?php
// Cierre de sesión para cualquier usuario
session_start();
session_unset();
session_destroy();
// Redirigir a la página principal (login y registro)
header('Location: login.php');
exit;
