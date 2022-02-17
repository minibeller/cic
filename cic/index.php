<?php
session_start();
include 'menu.php';
include 'conexao.php';


?>
<!--**
 * @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
 * o código é aberto e o uso é free, 
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 *-->

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if (!empty($_SESSION['email'] and $_SESSION['senha'])) {
    echo "
<div style='width: 100%;' class='row'>
        <div class='col-12 mb-3' style='width: 100%;'>
            <div class='row'>
                <div class='col-9'></div>
                <div class='col-3'>
                    <p class='text-end'> " . $_SESSION['nome'] . " seja bem vindo!</p>
                </div>
            </div>

            <div id='calendar'></div>
        </div>
    </div>


    <div class='modal fade' id='visualizar' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Detalhes do Evento</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='visevent'>
                        <dl class='row'>
                            <dt class='col-sm-3'>ID do evento</dt>
                            <dd class='col-sm-9' id='id'></dd>
                            
                            <dt class='col-sm-3'>Título do evento</dt>
                            <dd class='col-sm-9' id='title'></dd>

                            <dt class='col-sm-3'>Data do evento</dt>
                            <dd class='col-sm-9' id='start'></dd>

                        </dl>
                        <div class='row'>
                            <div class='col-6'>
                                <button style='width:100%' class='btn btn-warning btn-canc-vis'>Editar Evento</button>
                            </div>
                            <div class='col-6'>
                            <a style='width:100%' class='btn btn-primary float-right' id='informacao' (click)='informacao()'>Adicionar Informações</a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class='formedit'>
                        <span id='msg-edit'></span>
                        <form id='editevent' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='id' id='id'>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Título</label>
                                <div class='col-sm-10'>
                                    <input type='text' name='title' class='form-control' id='title' placeholder='Título do evento'>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Color</label>
                                <div class='col-sm-10'>
                                    <select name='color' class='form-control' id='color'>
                                        <option value='>Selecione</option>
                                        <option style='color:#FFD700;' value='#FFD700'>Amarelo</option>
                                        <option style='color:#0071c5;' value='#0071c5'>Azul Turquesa</option>
                                        <option style='color:#FF4500;' value='#FF4500'>Laranja</option>
                                        <option style='color:#8B4513;' value='#8B4513'>Marrom</option>
                                        <option style='color:#1C1C1C;' value='#1C1C1C'>Preto</option>
                                        <option style='color:#436EEE;' value='#436EEE'>Royal Blue</option>
                                        <option style='color:#A020F0;' value='#A020F0'>Roxo</option>
                                        <option style='color:#40E0D0;' value='#40E0D0'>Turquesa</option>
                                        <option style='color:#228B22;' value='#228B22'>Verde</option>
                                        <option style='color:#8B0000;' value='#8B0000'>Vermelho</option>
                                    </select>
                                </div>
                            </div>
                            <div class='form-group row'>
                                <label class='col-sm-2 col-form-label'>Data do evento</label>
                                <div class='col-sm-10'>
                                    <input type='text' name='start' class='form-control' id='start' onkeypress='DataHora(event, this)'>
                                </div>
                            </div>


                            <div class='form-group row'>
                                <div class='col-sm-12'>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <button style='width:100%' type='button' class='btn btn-primary btn-canc-edit'>Cancelar</button>
                                        </div>
                                        <div class='col-6'>
                                            <button style='width:100%' type='submit' name='CadEvent' id='CadEvent' value='CadEvent' class='btn btn-warning'>Salvar</button>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='cadastrar' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Cadastrar Evento</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <span id='msg-cad'></span>
                    <form method='post' action='cadastrar.php'>
                        <label class='col-sm-3 col-form-label'>Título</label>
                        <input type='text' name='title' class='form-control' id='title' placeholder='Título do evento'>
                        <label class='col-sm-3 col-form-label'>Início do evento</label>
                        <input type='datetime-local' name='start' class='form-control' id='start' onkeypress='DataHora(event, this)'>
                        <label class='col-sm-3 col-form-label'>Cor</label>
                        <select name='color' class='form-control'>
                            <option value='>Selecione</option>
                            <option style='color:#FFD700;' value='#FFD700'>Amarelo</option>
                            <option style='color:#0071c5;' value='#0071c5'>Azul Turquesa</option>
                            <option style='color:#FF4500;' value='#FF4500'>Laranja</option>
                            <option style='color:#8B4513;' value='#8B4513'>Marrom</option>
                            <option style='color:#1C1C1C;' value='#1C1C1C'>Preto</option>
                            <option style='color:#436EEE;' value='#436EEE'>Royal Blue</option>
                            <option style='color:#A020F0;' value='#A020F0'>Roxo</option>
                            <option style='color:#40E0D0;' value='#40E0D0'>Turquesa</option>
                            <option style='color:#228B22;' value='#228B22'>Verde</option>
                            <option style='color:#8B0000;' value='#8B0000'>Vermelho</option>
                        </select>
                        <input type='submit' style='width: 100%;' class='mt-4 btn btn-success'>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </body>

    </html>
";
} else {
    header("Location:login.php");
}

?>
<div class='row'>
    <div class='col-6'>
    </div>
    <div class='col-6'>
    </div>
</div>