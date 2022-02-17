<?php
session_start();
include 'menu.php';
include 'conexao.php';
?>


    <div class="row" style="width: 100%;">
    <div class="col-1"></div>
        <div class="col-10">
            <h2 class="text-center list-group-item list-group-item-secondary">ADICIONAR FORNECEDOR</h2>

            <form action='insert_fornecedor.php' method='post'>
                <div class='row mt-2'>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>CNPJ:</label>
                        <input type='text' class='form-control' placeholder='CNPJ:' name='cnpj' id='cnpj' aria-label='First name'>
                    </div>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>Razão Social:</label>
                        <input type='text' class='form-control' placeholder='Razão Social:' name='razao_social' aria-label='Last name'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>Nome:</label>
                        <input type='text' class='form-control' placeholder='Nome:' name='nome' id='nome' aria-label='First name'>
                    </div>  
                    <div class='col-6'>
                        <label for='formGroupExampleInput' class='form-label'>Telefone:</label>
                        <input type='text' class='form-control' placeholder='Telefone:' name='telefone' id='telefone' aria-label='First name'>
                    </div>                     
                </div>
                
                <div class='row'>
                    <div class='col-12'>
                        <label for='formGroupExampleInput' class='form-label'>E-mail:</label>
                        <input type='text' class='form-control' placeholder='E-mail:' name='email' id='email' aria-label='First name'>
                    </div>  
                                       
                </div>
                <div class='row mt-3 mb-3'>
                    <div class='col-6'>
                        <button type='submit' style='width: 100%' class='btn btn-success'>CADASTRAR</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-1">
    </div>


