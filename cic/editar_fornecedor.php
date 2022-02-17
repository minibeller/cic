<?php
session_start();
include 'menu.php';
include 'conexao.php';

if (!empty($_SESSION['email'] and $_SESSION['senha'])) {
    $query_events = "SELECT * FROM cic.fornecedor";
    $resultado_events = $conn->prepare($query_events);
    $resultado_events->execute();

    $eventos = [];

    while ($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)) {
        $id_fornecedor  = $row_events['id_fornecedor'];
        $cnpj = $row_events['cnpj'];
        $razao_social = $row_events['razao_social'];
        $nome = $row_events['nome'];
        $telefone = $row_events['telefone'];
        $email = $row_events['email'];


        $eventos[] = [
            'id_fornecedor' => $id_fornecedor,
            'cnpj' => $cnpj,
            'razao_social' => $razao_social,
            'nome' => $nome,
            'telefone' => $telefone,
            'email' => $email

        ];
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
                        <h2 class="text-center list-group-item list-group-item-secondary">EDITAR FORNECEDOR</h2>
                    </div>

                </div>
            </div>
        </div>


        <form action="salva_editar_fornecedor.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id_fornecedor" value="<?php echo $id_fornecedor ?>">
                    <label class="form-label">CNPJ</label>
                    <input type="text" class="form-control" value="<?php echo $cnpj ?>" name="cnpj">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Razão Social</label>
                    <input type="text" class="form-control" value="<?php echo $razao_social ?>" name="razao_social">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" class="form-control" value="<?php echo $nome ?>" name="nome">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telefone</label>
                    <input type="text" class="form-control" value="<?php echo $telefone ?>" name="telefone">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label class="form-label">E-mail</label>
                    <input type="text" class="form-control" value="<?php echo $email ?>" name="email">
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <button type="submit" style="width: 100%;" class="btn btn-success">SALVAR</button>
                </div>
                <div class="col-sm-6">
                    <a type="button" style="width: 100%;" class="btn btn-danger" href="fornecedor.php">CANCELAR</a>
                </div>
            </div>
        </form>

    </div>
    <div class="col-1"></div>
</div>