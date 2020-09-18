<?php
session_destroy();
setcookie("login","", 0);
header('Location: index.php');
exit();
