<?php
session_start();
include 'menu.php';
include 'conexao.php';
$id = $_GET['id'];

$sql = "SELECT * FROM cic.eventos where events_id = $id";
$resultado_events = $conn->prepare($sql);
$resultado_events->execute();


while ($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)) {

    $id_eventos  = $row_events['id_eventos'];
}


$sql2 = "DELETE FROM `cic`.`eventos` WHERE (`id_eventos` = '$id_eventos');";

$sql3 = "DELETE FROM `cic`.`events` WHERE (`id` = '$id');";

$conn->exec($sql2);
$conn->exec($sql3);
header('Location: index.php');
exit;