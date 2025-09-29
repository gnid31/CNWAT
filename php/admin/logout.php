<?php
session_start();
session_destroy();
header('Location: ../Enduser/login.php');
exit();
?>
