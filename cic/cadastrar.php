<?php
session_start();
include 'conexao.php';
include 'menu.php';


$title = $_POST['title'];
$start = $_POST['start'];
$color = $_POST['color'];
$data_start_conv = date("Y-m-d H:i:s", strtotime($start));



$sql = "INSERT INTO events (title, start, color)
VALUES ('".$title."', '".$data_start_conv."', '".$color."');";



if($conn->query($sql) == TRUE) {
  
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!<button type="button" class="close" data-dismiss="alert" aria-label="Close"></div>';
  header('Content-Type: application/json');
  echo json_encode($retorna);
  header('Location: index.php');
  /*echo "New record created successfully";*/
}else{
  $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi editado com sucesso!</div>'];
}





/*$insert_event = $conn->prepare();
$insert_event->bindParam(':title', $title );
$insert_event->bindParam(':color', $color);
$insert_event->bindParam(':start', $data_start_conv);

$insert_event->execute();


  /*$retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
  $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
} else {
  $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
}*/




/*if($query = $conn->query($sql)){
  header('Location: exibir_eventos.php');
}
else{
  echo "teste";
}*/
