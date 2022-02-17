<?php
session_start();
include 'conexao.php';
include 'menu.php';

$events_id = $_POST['events_id'];
$fornecedor = $_POST['fornecedor'];
$cic = $_POST['cic'];
$verba = $_POST['verba'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$prev_pagamento = date("Y-m-d H:i:s", strtotime($_POST['prev_pagamento']));
$forma_pagamento = $_POST['forma_pagamento'];
$valor_pago = $_POST['valor_pago'];
$cic_vencida = $_POST['cic_vencida'];
$cic_liquida = $_POST['cic_liquida'];
$observacao = $_POST['observacao'];
$user_id = $_POST['user_id'];


$sql = "INSERT INTO `cic`.`eventos` (`fornecedor_id_fornecedor`, `cic`, `verba`, `descricao`, 
`valor`, `prev_pagamento`, `forma_pagamento`, `valor_pago`, `saldo_aberto`, `cic_vencida`, 
`cic_liquida`, `observacao`, `user_id_user`, `events_id`) 
VALUES ('$fornecedor', '$cic', '$verba', '$descricao',
 '$valor', '$prev_pagamento', '$forma_pagamento', '$valor_pago', '0', '$cic_vencida', 
 '$cic_liquida', '$observacao', '$user_id', '$events_id');";





if($conn->query($sql) == TRUE) {
  
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close"></div>';
  header('Content-Type: application/json');
  echo json_encode($retorna);
  header('Location: index.php');
  /*echo "New record created successfully";*/
}else{
  $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi editado com sucesso!</div>'];
}



