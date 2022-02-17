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
                            <h2 class="text-center list-group-item list-group-item-secondary">LISTA CONTROLE DE INVESTIMENTOS COMERCIAIS</h2>
                        </div>

                    </div>
                    <div class="row ">
                        <div class="col-4 mt-2">
                            
                        </div>
                        <div class="col-4">
                          <a style="width: 100%;" href="add_fornecedor.php" type=" button" class="btn mt-2 btn-success">Adicionar Fornecedor</a>
                        </div>
                        <div class="col-4 mb-2">
                            <a type="button" href="filtro_fornecedor.php" style="width: 100%;" class="btn btn-primary text-white mt-2">Filtrar Informações </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12" style="min-height: 500px;">
                <div class="row">
                    <table class="table  table-striped table-hover text-center" style=" margin:auto; ">
                        <thead class="thead">
                            <tr>
                                <th scope="col-2">ID Fornecedor</th>
                                <th scope="col-2">CNPJ</th>
                                <th scope="col-2">Razão Social</th>
                                <th scope="col-2">Nome</th>
                                <th scope="col-2">Telefone</th>
                                <th scope="col-2">E-mail</th>
                                <th scope="col-2">APAGAR</th>
                                <th scope="col-2">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($eventos as $row_events) {
                                
                            ?>
                            
                             
                                 <tr>

                                    <td><?php echo $row_events['id_fornecedor']; ?></td>
                                    <td><?php echo $row_events['cnpj']; ?></td>
                                    <td><?php echo $row_events['razao_social']; ?></td>
                                    <td><?php echo $row_events['nome']; ?></td>
                                    <td><?php echo $row_events['telefone']; ?></td>
                                    <td><?php echo $row_events['email']; ?></td>

                                    <td><a type="button" style="width: 100%;" class="btn btn-danger" href="apagar_fornecedor.php?id=<?php echo $row_events['id_fornecedor']; ?>">APAGAR</a>
                                    <td><a type="button" style="width: 100%;" class="btn btn-warning" href="editar_fornecedor.php?id=<?php echo $row_events['id_fornecedor']; ?>">EDITAR</a>
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
