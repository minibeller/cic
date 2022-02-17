<?php
session_start();
include 'menu.php';
include 'conexao.php';
$fornecedor = $_POST['fornecedor'];
$cic = $_POST['cic'];
$cic_vencida = $_POST['cic_vencida'];
$cic_liquida = $_POST['cic_liquida'];
$verba = $_POST['verba'];

$sql = "SELECT * FROM eventos as e 
INNER JOIN fornecedor as f ON
fornecedor_id_fornecedor = '$fornecedor' OR
e.cic = '$cic' OR
e.cic_vencida = '$cic_vencida' OR
e.cic_liquida = '$cic_liquida' OR
e.verba = '$verba'  ;
";


$resultado_events = $conn->prepare($sql);
$resultado_events->execute();


while ($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)) {

    $id_eventos  = $row_events['id_eventos'];
    $razao_social = $row_events['razao_social'];
    $cic = $row_events['cic'];
    $prev_pagamento = $row_events['prev_pagamento'];
    $cic_vencida = $row_events['cic_vencida'];
    $cic_liquida = $row_events['cic_liquida'];
    $events_id = $row_events['events_id'];
    $eventos[] = [
        'id_eventos' => $id_eventos,
        'razao_social' => $razao_social,
        'cic' => $cic,
        'prev_pagamento' => $prev_pagamento,
        'cic_vencida' => $cic_vencida,
        'cic_liquida' => $cic_liquida,
        'events_id' => $events_id

    ];
}
?>
<div class="row" style="width: 100%;">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="text-center col-12">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center list-group-item list-group-item-secondary">Pesquisa de CIC'S</h1>
                    </div>

                </div>


            </div>
        </div>

        <div class="col-12" style="min-height: 500px;">
            <div class="row">
                <table class="table  table-striped table-hover text-center" style=" margin:auto; ">
                    <thead class="thead">
                        <tr>
                            <th scope="col-2">Razao Social</th>
                            <th scope="col-2">N° CIC</th>
                            <th scope="col-2">Previsão Pagamento</th>
                            <th scope="col-2">CIC Vencida</th>
                            <th scope="col-2">CIC Liquidada</th>
                            <th scope="col-2">Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($eventos as $row_events) {   
                         
                                echo "<tr>

                                    <td> ".$row_events['razao_social']."</td>
                                    <td> " . $row_events['cic'] . "</td>
                                    <td> " . date('d/m/Y', strtotime($row_events['prev_pagamento'])) . "</td>
                                    <td> " . $row_events['cic_vencida'] . "</td>
                                    <td> " . $row_events['cic_liquida'] . "</td>
    
                                    <td><a type='button' style='width: 100%;' class='btn btn-primary' href='visualizar_evento.php?id=" . $row_events['events_id'] . "'>Visualizar</a>
                                </tr>";
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