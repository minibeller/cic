<?php
session_start();
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


if (!empty($_SESSION['email'])) {
    header('location: index.php');
} else {
    echo "<!DOCTYPE html>
   <html class='container '>
   <head>
       <meta charset='utf-8' />
       <link href='css/core/main.min.css' rel='stylesheet' />
       <link href='css/daygrid/main.min.css' rel='stylesheet' />
       <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
       <link rel='stylesheet' href='css/personalizado.css'>
   
       <script src='js/core/main.min.js'></script>
       <script src='js/interaction/main.min.js'></script>
       <script src='js/daygrid/main.min.js'></script>
       <script src='js/core/locales/pt-br.js'></script>
       <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
       <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
       <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
       <script src='js/personalizado.js'></script>
   </head>
   <body class=' ' style='background-color: #bdcdd0  '>   
   <div style='background-color:white; border: 1px solid;
   border-radius: 25px;'>
       <form class='form-signin' action='verifica_login.php' method='post' >
           
           <div class='row p-5'>
               <div class='col-7'>
               <img style='width:100%'class='mb-4 mt-4 shadow-lg p-3 mb-5 bg-white rounded' src='img/ico.png'  >  
               </div>
               <div class='col-5  mt-4 '>
               <h3 class='mt-2 text-center font-weight-bold'>CONTROLE DE INVESTIMENTOS COMERCIAIS</h3>
               <div class='mt-3'>
                   <label for='exampleInputEmail1' class='form-label font-weight-bold'>E-MAIL: </label>
                   <input type='email' name='email' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'>                       
               </div>
               <div class='mt-4'>
                   <label for='exampleInputPassword1' class='form-label font-weight-bold'>SENHA: </label>
                   <input type='password' name='senha' class='form-control' id='exampleInputPassword1'>
               </div>              
               <button type='submit' style='width: 100%;' class='btn btn-success mt-3 mb-5'>LOGIN</button>             
               </div>   
                 
           </div>
            <div class='row'>
                <div class='col-sm-12'>
                <p class='text-center'>© 2022 MANTIQUEIRA DISTRIBUIDORA - Tecnologia da Informação e Comunicação</p>
                </div>
            </div>
       </form>
   </div>
   </body>";
}
?>



</div>