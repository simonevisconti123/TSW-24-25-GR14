<?php
session_start();
session_unset(); // Rimuove tutte le variabili di sessione
session_destroy(); // Distrugge la sessione

// Reindirizza alla pagina di login o alla homepage
header("Location: ../index.php");
exit();
?>
