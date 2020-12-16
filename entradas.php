<?php 

require_once("conex.php");
require_once("definicoes.php");
@session_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>Entradas & Saídas | MRH</title>
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.png"/>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
  <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Moment JS -->
  <script src="bower_components/moment/moment.js"></script>

</head>
<body class="form">


  <div class="form-container outer">
    <div class="form-form">
      <div class="form-form-wrap">
        <div class="form-container">
          <div class="form-content">

                      <?php // Array com os dias da semana
                      $diasemana = array('Domingo', 'Segunda Feira', 'Terça Feira', 'Quarta Feira', 'Quinta Feira', 'Sexta Feira', 'Sábado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
                      $data = date('Y-m-d');

// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
                      $diasemana_numero = date('w', strtotime($data)); ?>

                      <h1><?php
                      echo  $diasemana[$diasemana_numero]; ?> | <?php $date = date('d-m-Y'); echo $date;?></h1>
                      <b><h4 id="time" class="bold"></h4></b>  
                      <style type="text/css">
                        h1{margin-bottom: 30px;}
                      </style>
                      <form class="text-left" id="attendance">
                        <div class="form">
                          <div id="username-field" class="field-wrapper input">
                            <label for="username">SELECIONAR ACÇÃO</label>
                            <select class="form-control" name="status">
                              <option value="in">Entrada</option>
                              <option value="out">Saída</option>
                            </select>
                          </div>

                          <div id="username-field" class="field-wrapper input">
                            <label for="username">CÓDIGO USUÁRIO</label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <input id="employee" name="employee" required type="text" class="form-control" placeholder="">
                          </div>
                          <div class="d-sm-flex justify-content-between">
                            <div class="field-wrapper">
                              <button type="submit" class="btn btn-primary" id="btn-login" name="btn-login" value="">Confirmar</button>
                            </div>

                          </div>
                          <p class="signup"><b><a class="bex" href="index.php">Voltar Login?</a></b></p>
                          <style type="text/css">
                            .bex, .signup {
                              text-align: center;
                              margin-top: 25px;
                              font-size: 18px;
                              text-decoration: none;
                            }
                          </style>
                        </div>
                      </form>

                    </div>                    
                  </div>
                </div>
              </div>
            </div>



            <script type="text/javascript">
              $(function() {
                var interval = setInterval(function() {
                  var momentNow = moment();
                  $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
                  $('#time').html(momentNow.format('hh:mm:ss A'));
                }, 100);

                $('#attendance').submit(function(e){
                  e.preventDefault();
                  var attendance = $(this).serialize();
                  $.ajax({
                    type: 'POST',
                    url: 'horario.php',
                    data: attendance,
                    dataType: 'json',
                    success: function(response){
                      if(response.error){
                        $('.alert').hide();
                        $('.alert-danger').show();
                        $('.message').html(response.message);
                      }
                      else{
                        $('.alert').hide();
                        $('.alert-success').show();
                        $('.message').html(response.message);
                        $('#employee').val('');
                      }
                    }
                  });
                });

              });
            </script>

            <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
            <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
            <script src="bootstrap/js/popper.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>

            <!-- END GLOBAL MANDATORY SCRIPTS -->
            <script src="assets/js/authentication/form-2.js"></script>

          </body>
          </html>