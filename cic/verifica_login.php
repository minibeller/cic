<?php

include 'conexao.php';
$email  =  $_POST['email'];
$senha  =  $_POST['senha'];

$sql = "SELECT id_user, email, senha,nome FROM user WHERE email = '$email' AND senha = '$senha'";


$resultado_events = $conn->prepare($sql);
$resultado_events->execute();

while($row = $resultado_events->fetch(PDO::FETCH_ASSOC)){
 
        $id_user = $row['id_user'];
        $email = $row['email'];
        $senha = $row['senha'];
        $nome = $row['nome'];
    }

if(!empty($email and $senha)){
    session_start();
    $_SESSION['id_user'] = $id_user;
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = $nome;

    header('location:index.php');
}
else{
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi editado com sucesso!</div>'];
}