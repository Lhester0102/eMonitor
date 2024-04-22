<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
    $_SESSION = array();
    session_regenerate_id(true);
}
header("Location: log-in.php");
exit();
?>
