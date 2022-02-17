<?php
session_start();

include 'conexao.php';
    $id_fornecedor  = $_POST['id_fornecedor'];
    $id_eventos  = $_POST['id_eventos'];
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $cic = $_POST['cic'];
    $verba = $_POST['verba'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $prev_pagamento = $_POST['prev_pagamento'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $valor_pago = $_POST['valor_pago'];
    $cic_vencida = $_POST['cic_vencida'];
    $cic_liquida = $_POST['cic_liquida'];
    $observacao = $_POST['observacao'];
    $events_id = $_POST['events_id'];
    $user_id_user = $_POST['user_id'];

    $sql ="
    UPDATE cic.eventos
    SET   
    cic = '$cic',
    verba = '$verba',
    descricao = '$descricao',
    valor = '$valor',
    prev_pagamento = '$prev_pagamento',
    forma_pagamento = '$forma_pagamento',
    valor_pago = '$valor_pago',
    cic_vencida = '$cic_vencida',
    cic_liquida = '$cic_liquida',
    observacao = '$observacao',
    fornecedor_id_fornecedor = '$id_fornecedor'
    WHERE (`id_eventos` = '$id_eventos') and (`user_id_user` = '$user_id_user') and (`events_id` = '$events_id');
    ";

    $conn->exec($sql);
    header('Location: lista.php');
?>
