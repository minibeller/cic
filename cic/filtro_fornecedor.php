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
            <form action='pesquisa_filtro_fornecedor.php' method='post'>
                <div class='row mt-2'>
                    <div class='col-6'>
                    <label class='form-label'>Fornecedor</label>
                    <select class='form-control' name='fornecedor'>";
                      
                        while ($row_events2 = $resultado_events2->fetch(PDO::FETCH_ASSOC)) {
                            $id_fornecedor = $row_events2['id_fornecedor'];
                            echo $razao_social  = $row_events2['razao_social'];
                            echo "<option value='$id_fornecedor'>$razao_social</option>";
                        }
                        
                      echo" 
                    </select>
                    </div>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>CNPJ</label>
                        <input type='text' class='form-control' placeholder='CNPJ sem ponto ou traço' name='cnpj' aria-label='Last name'>
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
