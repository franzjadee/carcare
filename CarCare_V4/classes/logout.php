<?php
session_start();


$_SESSION = [];


session_destroy();


header("Location: ../view/login.php");
exit();