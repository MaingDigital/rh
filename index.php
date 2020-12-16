<?php 

require_once("conex.php");
require_once("definicoes.php");
//@session_start();

//VERIFICAR SE EXISTE REGISTRO NA TABELA USUARIOS E SE NÃO EXISTIR CRIAR
$senha = '123';
$senha_cript = md5($senha);
$res_usuarios = $pdo->query("SELECT * from usuarios");
$dados_usuarios = $res_usuarios->fetchAll(PDO::FETCH_ASSOC);
$total_usuarios = count($dados_usuarios);

if($total_usuarios == 0){
  $res_insert = $pdo->query("INSERT into usuarios (nome, usuario, senha, senha_original, cargo) values ('Administrador', '$email_adm', '$senha_cript', '$senha', 'Administrador')");
}
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login | MRH</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body class="form">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Aceder MRH</h1>
                        <p class="">Gestão de Recursos Humanos</p>
                        
                        <form class="text-left" method="post" action="auth.php">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USUÁRIO</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="usuario" name="usuario" type="text" class="form-control" placeholder="">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">SENHA</label>
                                        <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">Esqueceu a Senha?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="senha" name="senha" type="password" class="form-control" placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" id="btn-login" name="btn-login" value="">Aceder</button>
                                    </div>
                                </div>
                                <p class="signup text-primary"><b><a class="bex" href="entradas.php">Registrar Entrada ou Saída?</a></b></p>
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

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>

</body>
</html>