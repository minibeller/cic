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
    $cic = $row_events['cic'];
    $verba = $row_events['verba'];
    $descricao = $row_events['descricao'];
    $valor = $row_events['valor'];
    $prev_pagamento = $row_events['prev_pagamento'];
    $forma_pagamento = $row_events['forma_pagamento'];
    $valor_pago = $row_events['valor_pago'];
    $cic_vencida = $row_events['cic_vencida'];
    $cic_liquida = $row_events['cic_liquida'];
    $observacao = $row_events['observacao'];
    $events_id = $row_events['events_id'];
    $user_id_user = $row_events['user_id_user'];
    $fornecedor_id_fornecedor = $row_events['fornecedor_id_fornecedor'];
}
$sql2 = "SELECT * FROM cic.fornecedor where id_fornecedor = $fornecedor_id_fornecedor";

$resultado_events2 = $conn->prepare($sql2);
$resultado_events2->execute();


?>
<div class="row" style="width: 100%;">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-md-12 text-center">
            <div class='col-12 list-group-item list-group-item-secondary'>
                        <h2 class='text-center '>EDITAR CONTROLE DE INVESTIMENTOS COMERCIAIS</h2>
                    </div>
                <h1></h1>
            </div>
        </div>
        <form action="salva_editar.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label class='form-label'>Fornecedor</label>
                    <select class='form-control' name='id_fornecedor'>";
                        <?php
                        while ($row_events2 = $resultado_events2->fetch(PDO::FETCH_ASSOC)) {
                            $id_fornecedor = $row_events2['id_fornecedor'];
                            echo $razao_social  = $row_events2['razao_social'];
                            echo "<option value='$id_fornecedor'>$razao_social</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">N° CIC</label>
                    <input type="text" class="form-control" value="<?php echo $cic ?>" name="cic">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Código Verba</label>
                    <input type="text" class="form-control" value="<?php echo $verba ?>" name="verba">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Descrição</label>
                    <input type="text" class="form-control" value="<?php echo $descricao ?>" name="descricao">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Valor</label>
                    <input type="text" class="form-control" value="<?php echo $valor ?>" name="valor">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Previsão Pagamento</label>
                    <input type="date" class="form-control" value="<?php echo $prev_pagamento ?>" name="prev_pagamento">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Forma Pagamento</label>
                    <select class='form-control' name='forma_pagamento'>
                        <option value="<?php echo $forma_pagamento ?>"><?php echo $forma_pagamento ?></option>
                        <option value='PIX'>DEPÓSITO EM CONTA</option>
                        <option value='PIX'>PIX</option>
                        <option value='PIX'>BOLETO</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Valor Pago</label>
                    <input type="text" class="form-control" value="<?php echo $valor_pago ?>" name="valor_pago">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">CIC Vencida</label>
                    <div class='form-group'>
                        <select class='form-control' name='cic_vencida'>
                            <option value="<?php echo $cic_vencida ?>">SIM</option>
                            <option value='SIM'>SIM</option>
                            <option value='NÃO'>NÃO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">CIC Liquidada</label>
                    <div class='form-group'>
                        <select class='form-control' name='cic_liquida'>
                            <option value="<?php echo $cic_liquida ?>">SIM</option>
                            <option value='SIM'>SIM</option>
                            <option value='NÃO'>NÃO</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Observação</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="observacao" rows="3"><?php echo $observacao ?></textarea>
                </div>
            </div>
            <input type="hidden" name="events_id" value="<?php echo $id ?>">
            <input type="hidden" name="id_eventos" value="<?php echo $id_eventos ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id_user'] ?>">
            <div class="row">
                <div class="col-md-6 mt-3">
                    <button type="submit" style="width: 100%;" class="btn btn-success mb-3">SALVAR</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-1"></div>
</div>