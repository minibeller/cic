<?php
session_start();
include 'menu.php';
include 'conexao.php';

$cnpj = $_POST['cnpj'];
$razao_social = $_POST['razao_social'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$sql = "INSERT INTO fornecedor (cnpj,razao_social,nome,telefone,email)
VALUES ('".$cnpj."','".$razao_social."','".$nome."','".$telefone."','".$email."');";


$conn->exec($sql);
header('Location: lista.php');
  

?>
