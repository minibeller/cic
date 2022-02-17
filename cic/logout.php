<?php
session_start();
unset($_SESSION["id_user"]);
unset($_SESSION["email"]);
unset($_SESSION["senha"]);
unset($_SESSION["nome"]);


header("Location:login.php");
?>