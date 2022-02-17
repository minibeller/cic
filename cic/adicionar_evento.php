<?php
session_start();
include 'menu.php';
include 'conexao.php';
$id = $_GET['id'];


$query_events = "SELECT events_id FROM eventos WHERE events_id = $id";
$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();



while ($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)) {
    $events_id = $row_events['events_id'];
}


$query_events2 = "SELECT * FROM fornecedor";
$resultado_events2 = $conn->prepare($query_events2);
$resultado_events2->execute();


if (empty($events_id)) {

?>
    <div class="row" style="width: 100%;">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="text-center list-group-item list-group-item-secondary">Adicionar CIC</h1>
                </div>
            </div>
            <form action="cadastra_devolucao.php" method="post">
                <div class="row">
                    <div class="col-md-6">
                    <label class="form-label">Fornecedor</label>
                        <select class='form-control' name='fornecedor'>
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
                        <input type="text" class="form-control" name="cic">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Código Verba</label>
                        <input type="text" class="form-control" name="verba">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="descricao">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Previsão Pagamento</label>
                        <input type="date" class="form-control" name="prev_pagamento">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Forma Pagamento</label>
                        <select class='form-control' name='forma_pagamento'>
                            <option value='DEPÓSITO EM CONTA'>DEPÓSITO EM CONTA</option>
                            <option value='BONIFICAÇÃO'>BONIFICAÇÃO</option>
                            <option value='DESCONTO EM BOLETO'>DESCONTO EM BOLETO</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Valor Pago</label>
                        <input type="text" class="form-control" name="valor_pago">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">CIC Vencida</label>
                        <div class='form-group'>
                            <select class='form-control' name='cic_vencida'>
                                <option value='EM ABERTO'>EM ABERTO</option>
                                <option value='SIM'>SIM</option>
                                <option value='NÃO'>NÃO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">CIC Liquidada</label>
                        <div class='form-group'>
                            <select class='form-control' name='cic_liquida'>
                                <option value='EM ABERTO'>EM ABERTO</option>
                                <option value='SIM'>SIM</option>
                                <option value='NÃO'>NÃO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">Observação</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="observacao" rows="3"></textarea>
                    </div>
                </div>
                <input type="hidden" name="events_id" value="<?php echo $id ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['id_user'] ?>">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <button type="submit" style="width: 100%;" class="btn btn-success mb-3">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-1"></div>
    </div>




<?php
} else {


    header("Location: visualizar_evento.php?id=$events_id");
}

?>