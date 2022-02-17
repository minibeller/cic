<?php
session_start();
include 'menu.php';
include 'conexao.php';
$hoje = date('Y/m/d');
if (!empty($_SESSION['email'] and $_SESSION['senha'])) {
    $query_events = "SELECT * FROM cic.eventos";
    $resultado_events = $conn->prepare($query_events);
    $resultado_events->execute();

    $eventos = [];

    while ($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)) {
        $id_eventos  = $row_events['id_eventos'];
        $fornecedor_id_fornecedor = $row_events['fornecedor_id_fornecedor'];
        $cic = $row_events['cic'];
        $prev_pagamento = $row_events['prev_pagamento'];
        $cic_vencida = $row_events['cic_vencida'];
        $cic_liquida = $row_events['cic_liquida'];
        $saldo_aberto = $row_events['saldo_aberto']; 
        $valor = $row_events['valor'];
        $valor_pago = $row_events['valor_pago'];
        $events_id = $row_events['events_id'];

        $query_events2 = "SELECT razao_social FROM cic.fornecedor WHERE id_fornecedor = $fornecedor_id_fornecedor";
        $resultado_events2 = $conn->prepare($query_events2);
        $resultado_events2->execute();

        while ($row_events2 = $resultado_events2->fetch(PDO::FETCH_ASSOC)) {

            $razao_social = $row_events2['razao_social'];
            $eventos[] = [
                'id_eventos' => $id_eventos,
                'razao_social' => $razao_social,
                'cic' => $cic,
                'prev_pagamento' => $prev_pagamento,
                'cic_vencida' => $cic_vencida,
                'cic_liquida' => $cic_liquida,
                'saldo_aberto' => $saldo_aberto,
                'valor' => $valor,
                'valor_pago' => $valor_pago,
                'events_id' => $events_id

            ];
           
           
        }
    }
    
} else {
    header('Location: login.php');
}

foreach ($eventos as $row_events) {
  
    
    $prev_pagamento = $row_events['prev_pagamento'];
    $id_eventos  = $row_events['id_eventos'];
    if (strtotime($prev_pagamento) <  strtotime($hoje)) {
        $update = "UPDATE cic.eventos
        SET 
        cic_vencida = 'SIM'
        WHERE (`id_eventos` = '$id_eventos');";
        $conn->exec($update);
    }
    elseif(strtotime($prev_pagamento) >= strtotime($hoje)) {
        $update = "UPDATE cic.eventos
        SET 
        cic_vencida = 'NÃO'
        WHERE (`id_eventos` = '$id_eventos'); ";
        $conn->exec($update);
    }

}

foreach ($eventos as $row_events) {
    $valor_pago = $row_events['valor_pago'];
    $saldo_aberto = $row_events['saldo_aberto'];
    $valor = $row_events['valor'];
    $id_eventos  = $row_events['id_eventos'];
    if ($valor_pago < $valor) {
        $saldo_aberto = $valor - $valor_pago;
        $update = "UPDATE cic.eventos
        SET 
        saldo_aberto = '$saldo_aberto',
        cic_liquida = 'NÃO'
        WHERE (`id_eventos` = '$id_eventos');";
        $conn->exec($update);
    }
    elseif($valor_pago >= $valor) {
        $saldo_aberto = $valor - $valor_pago;
        $update = "UPDATE cic.eventos
        SET 
        saldo_aberto = '$saldo_aberto',
        cic_liquida = 'SIM'
        WHERE (`id_eventos` = '$id_eventos'); ";
        $conn->exec($update);
    }

}



          


?>
<div class="row" style="width: 100%;">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center list-group-item list-group-item-secondary">LISTA CONTROLE DE INVESTIMENTOS COMERCIAIS</h2>
                    </div>

                </div>
                <div class="row ">
                    <div class="col-3 mt-2">

                    </div>
                    <div class="col-5">

                    </div>
                    <div class="col-4 mb-2">
                        <a type="button" href="filtro.php" style="width: 100%;" class="btn btn-secondary text-white mt-2">Filtrar Informações </a>
                    </div>
                </div>

            </div>
        </div>
        <div class='col-12' style='min-height: 500px;'>
            <div class='row'>
                <table class='table  table-striped table-hover text-center' style=' margin:auto; '>
                    <thead class='thead'>
                        <tr>
                            <th scope='col-2'>Nome Fornecedor</th>
                            <th scope='col-2'>N° CIC</th>
                            <th scope='col-2'>Previsão Pagamento</th>
                            <th scope='col-2'>CIC Vencida</th>
                            <th scope='col-2'>CIC Liquidada</th>
                            <th scope='col-2'>Visualizar</th>
                        </tr>
                    </thead>


                    <?php
                    foreach ($eventos as $row_events) {
                        $cic_vencida = $row_events['cic_vencida'];
                        $cic_liquida = $row_events['cic_liquida'];
                        if($cic_vencida == 'SIM'){
                    
                            $color= 'class="table-danger text-dark"';      
                          }
                          elseif ($cic_liquida == "SIM"){
                              $color= 'class="table-success text-dark"'; 
                          }
                          else{
                            $color= 'class="table-secondary text-dark"'; 
                          }

                    ?>

                            <tbody <?php echo $color;?>>
                                <tr>

                                    <td><?php echo $row_events['razao_social']; ?></td>
                                    <td><?php echo $row_events['cic']; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($row_events['prev_pagamento'])); ?></td>
                                    <td><?php echo $row_events['cic_vencida']; ?></td>
                                    <td><?php echo $row_events['cic_liquida']; ?></td>

                                    <td><a type="button" style="width: 100%;" class="btn btn-primary" href="visualizar_evento.php?id=<?php echo $row_events['events_id']; ?>">Visualizar</a>
                                </tr>

                            <?php

                    }



                        ?>

                        <tr>
                        </tr>
                            </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-1"></div>
</div>