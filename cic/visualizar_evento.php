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
    $nome_fornecedor = $row_events['nome_fornecedor'];
    $cic = $row_events['cic'];
    $verba = $row_events['verba'];
    $descricao = $row_events['descricao'];
    $valor = $row_events['valor'];
    $prev_pagamento = $row_events['prev_pagamento'];
    $forma_pagamento = $row_events['forma_pagamento'];
    $valor_pago = $row_events['valor_pago'];
    $saldo_aberto = $row_events['saldo_aberto'];
    $cic_vencida = $row_events['cic_vencida'];
    $cic_liquida = $row_events['cic_liquida'];
    $observacao = $row_events['observacao'];
    $user_id_user = $row_events['user_id_user'];
    $events_id = $row_events['events_id'];
    $fornecedor_id_fornecedor = $row_events['fornecedor_id_fornecedor'];
}
$query_events4 = "SELECT razao_social FROM cic.fornecedor WHERE id_fornecedor = $fornecedor_id_fornecedor";
$resultado_events4 = $conn->prepare($query_events4);
$resultado_events4->execute();

while ($row_events4 = $resultado_events4->fetch(PDO::FETCH_ASSOC)) {

    $razao_social = $row_events4['razao_social'];
}

$sql2 = "SELECT * FROM events WHERE id = $events_id";
$resultado_events2 = $conn->prepare($sql2);
$resultado_events2->execute();
while ($row_events2 = $resultado_events2->fetch(PDO::FETCH_ASSOC)) {

    $id  = $row_events2['id'];
    $title = $row_events2['title'];
    $color = $row_events2['color'];
    $start = $row_events2['start'];
}

$sql3 = "SELECT nome FROM user WHERE id_user = $user_id_user";
$resultado_events3 = $conn->prepare($sql3);
$resultado_events3->execute();
while ($row_events3 = $resultado_events3->fetch(PDO::FETCH_ASSOC)) {

    $nome  = $row_events3['nome'];
}

$saldo_aberto = $valor - $valor_pago;

if ($saldo_aberto == 0) {
    $update = "UPDATE cic.eventos
    SET 
    cic_liquida = 'SIM'
    WHERE (`id_eventos` = '$id_eventos'); ";
    $conn->exec($update);
}

$valor = number_format($valor, 2);
$valor_pago = number_format($valor_pago, 2);
$saldo_aberto = number_format($saldo_aberto, 2);


$prev_pagamento = date("d/m/Y", strtotime($prev_pagamento));
if (!empty($_SESSION['email'] and $_SESSION['senha'])) {

    echo "
    <div class='row' style='width:100%'>
    <div class='col-1'></div>
    <div class='col-10'>
    <form>
        <div class='row'>
        
            <div class='col-md-12 mb-5 '>
                <div class='row'>
                    <div class='col-12 list-group-item list-group-item-secondary'>
                        <h2 class='text-center '>CIC -  CONTROLE DE INVESTIMENTOS COMERCIAIS</h2>
                    </div>
                </div>

               
                <div class='row'>
                    <div class='col-12 p-0'>
                        
                            <div class='col-12 p-0 houver' style='padding-right:0px !important'>
                                <p class='list-group-item list-group-item-action'>Título: " . $title . "</p>
                            </div>
                        
                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>Nome Fornecedor: $razao_social</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>CIC: $cic</p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>Referência fornecedor: $verba</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>Descrição: $descricao</p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>Valor: $valor</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>Previsão de Pagamento: $prev_pagamento </p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>Forma de Pagamento: $forma_pagamento</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>Valor Pago: $valor_pago</p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>Saldo em Aberto: $saldo_aberto</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>CIC Vencida: $cic_vencida</p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-6 p-0 houver' style='padding-right:0px !important'>
                        <p class='list-group-item list-group-item-action'>CIC Liquidada: $cic_liquida</p>

                    </div>
                    <div class='col-6 p-0 houver' style='padding-left:0px !important'>
                        <p class='list-group-item list-group-item-action'>Usuário Responsável: $nome</p>

                    </div>
                </div>
                <div class='row'>
                    <div class='col-12 p-0 houver' style='padding-right:0px !important'>
                        <textarea class='list-group-item list-group-item-action  ' 
                        style='margin-top: 0px; margin-bottom: 0px; height: 80px;'>Observação: $observacao</textarea>
                    </div>                    
                </div>
                <div class='row mt-5'>
                    <div class='col-4 p-0 houver' style='padding-left:0px !important'>
                    
                        <input class='btn btn-primary' style='width:100%' type='button' value='IMPRIMIR CIC' onClick='window.print()'/>
                    
                    </div>
                    <div class='col-4 p-0 houver' style='padding-right:0px !important'>
                        <a type='button' href='apagar_evento.php?id=$id' style='width:100%' class='btn btn-danger'>APAGAR</a>
                    </div>
 
                    <div class='col-4 p-0 houver' style='padding-left:0px !important'>
                        <a type='button' href='editar.php?id=$id' style='width:100%' class='btn btn-warning'>EDITAR</a>
                    </div>
                </div>
               
            </div>
     
        </div>
        </form>
    </div>
    <div class='col-1'></div>
</div>
    ";
} else {
}
?>

<div class='row'>
    <div class='col-12'>

    </div>
</div>

<?php


?>