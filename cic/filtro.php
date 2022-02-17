<?php
session_start();
include 'menu.php';
include 'conexao.php';

$query_events2 = "SELECT * FROM fornecedor";
$resultado_events2 = $conn->prepare($query_events2);
$resultado_events2->execute();

if (!empty($_SESSION['email'] and $_SESSION['senha'])) {
    echo "
    <div class='row' style='width: 100%;'>
        <div class='col-1'></div>
        <div class='col-10'>
            <div class='row'>
                <div class='text-center col-12'>
                    <h2 class='text-center list-group-item list-group-item-secondary'>FILTRO CONTROLE DE INVESTIMENTOS COMERCIAIS</h2>
                </div>
            </div>
            <form action='pesquisa_filtro.php' method='post'>
                <div class='row mt-2'>
                    <div class='col-6'>
                    <label class='form-label'>Fornecedor</label>
                    <select class='form-control' name='fornecedor'>";
                        echo "<option value=''>SELECIONAR</option>";
                        while ($row_events2 = $resultado_events2->fetch(PDO::FETCH_ASSOC)) {
                            $id_fornecedor = $row_events2['id_fornecedor'];
                            echo $razao_social  = $row_events2['razao_social'];
                            echo "<option value='$id_fornecedor'>$razao_social</option>";
                        }
                        
                      echo" 
                    </select>
                    </div>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>N° CIC</label>
                        <input type='text' class='form-control' placeholder='N° CIC' name='cic' aria-label='Last name'>
                    </div>
                </div>
                <div class='row mt-2'>
                    <div class='col-6'>
                    <div class='form-group'>
                    <label for='formGroupExampleInput' class='form-label'>CIC Vencida</label>
                    <select class='form-control' name='cic_vencida'>
                        <option value=''>SELECIONAR</option>
                        <option value='EM ABERTO'>EM ABERTO</option>
                        <option value='SIM'>SIM</option>
                        <option value='NÃO'>NÃO</option>
                    </select>
                </div>
                    </div>
                    <div class='col-6'>
                        <div class='form-group'>
                            <label for='formGroupExampleInput' class='form-label'>CIC Liquidada</label>
                            <select class='form-control' name='cic_liquida'>
                                <option value=''>SELECIONAR</option>
                                <option value='EM ABERTO'>EM ABERTO</option>
                                <option value='SIM'>SIM</option>
                                <option value='NÃO'>NÃO</option>
                            </select>
                        </div>
                    </div>
                </div>
      
                <div class='row'>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>Código Verba</label>
                        <input type='text' class='form-control' placeholder='Código Verba' name='verba' id='verba' aria-label='First name'>
                    </div>                    
                </div>
                <div class='row mt-3 mb-3'>
                    <div class='col-6'>
                        <button type='submit' style='width: 100%' class='btn btn-success'>FILTRAR</button>
                    </div>
                </div>
            </form>
        </div>
        <div class='col-1'></div>
    </div>
    ";
} else {
    header('Location: login.php');
}
?>
