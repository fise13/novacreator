<?php
/**
 * Выход из админ-панели
 */
session_start();
session_destroy();
header('Location: login.php');
exit;
?>

