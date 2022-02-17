<?php
session_start();

include 'conexao.php';


$cnpj = $_POST['cnpj'];
$razao_social = $_POST['razao_social'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$id_fornecedor = $_POST['id_fornecedor'];

$sql = "UPDATE fornecedor SET
 cnpj='$cnpj',
 razao_social='$razao_social',
 nome='$nome',
 telefone='$telefone',
 email='$email'
 WHERE id_fornecedor = $id_fornecedor";



$conn->exec($sql);
header('Location: fornecedor.php');