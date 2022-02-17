<?php
session_start();
include 'menu.php';
include 'conexao.php';

$id_fornecedor = $_GET['id'];

$sql = "DELETE FROM eventos WHERE fornecedor_id_fornecedor =$id_fornecedor";


$resultado_events = $conn->prepare($sql);
$resultado_events->execute();

$sql2 = "DELETE FROM fornecedor WHERE id_fornecedor =$id_fornecedor";


$resultado_events2 = $conn->prepare($sql2);
$resultado_events2->execute();

header("Location: fornecedor.php");