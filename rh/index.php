<?php   

//verficações para o Login
require_once("../conex.php");
require_once("../definicoes.php");
//require_once("consultas-notificacoes.php");

@session_start();
if(!isset($_SESSION['nome_usuario']) || $_SESSION['cargo_usuario'] != 'Gestor'){
    header("location:../index.php");
}

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda Feira', 'Terça Feira', 'Quarta Feira', 'Quinta Feira', 'Sexta Feira', 'Sábado');

// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
$data = date('Y-m-d');

// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
$diasemana_numero = date('w', strtotime($data));

// Exibe o dia da semana com o Array

$notificacoes = 0;

//VARIÁVEIS DOS MENUS
$item1 = 'home';
$item2 = 'funcionarios';
$item3 = 'medicos';
$item4 = 'cargos';
//$item5 = 'especialidades';
$item6 = 'calendario';
$item7 = 'ausencias';
$item8 = 'pagamentos';
$item9 = 'turnos';
$item10 = 'usuarios';
$item11 = 'perfil';



    //VERIFICAR QUAL O MENU CLICADO E PASSAR A CLASSE ATIVO
if(@$_GET['acao'] == $item1){
    $item1ativo = 'true';
}elseif(@$_GET['acao'] == $item2){
    $item2ativo = 'true';
}elseif(@$_GET['acao'] == $item3){
    $item3ativo = 'true';
}elseif(@$_GET['acao'] == $item4){
    $item4ativo = 'true';
}elseif(@$_GET['acao'] == $item6){
    $item6ativo = 'true';
}elseif(@$_GET['acao'] == $item7){
    $item7ativo = 'true';
}elseif(@$_GET['acao'] == $item8){
    $item8ativo = 'true';
}elseif(@$_GET['acao'] == $item9){
    $item9ativo = 'true';
}elseif(@$_GET['acao'] == $item10){
    $item10ativo = 'true';
}elseif(@$_GET['acao'] == $item11){
    $item11ativo = 'true';
}else{
    $item1ativo = 'true';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Gestão de Recursos Humanos | MRH </title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <link href="../assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="../plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <link href="../plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/fullcalendar/custom-fullcalendar.advance.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="../plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLE -->
    <style>
        .widget-content-area { border-radius: 6px; margin-bottom: 10px; }
        .daterangepicker.dropdown-menu {
            z-index: 1059;
        }
    </style>

</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow text-info align-self-center loader-lg"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="">
                        <img src="../assets/img/logi1.png" class="navbar-logo" alt="logo" style="width: 35px; height: 20px;">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="" class="nav-link"> MAINGUE RH </a>
                </li>
            </ul>


            <ul class="navbar-item flex-row ml-md-auto mr-4">
                <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
                    <a class="nav-link dropdown-toggle" href="#"><svg title="Definições do Sistema" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                </li>
                <li title="Bloquear Sistema" class="nav-item dropdown message-dropdown theme-text">
                    <a class="nav-link dropdown-toggle" href="../bloquear.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></a>
                </li>
            
                 <li title="Sair do Sistema" class="nav-item dropdown message-dropdown theme-text">
                    <a class="nav-link dropdown-toggle" data-toggle="modal" data-target="#modal1" type="button"><svg title="Sair do Sistema" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></a>
                </li>


            </ul>
        </header>
    </div>

    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Gestão de Recursos Humanos</a></li>
                             <!--   <li class="breadcrumb-item active" aria-current="page"><span></span></li> -->
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto mr-4">
                <li class="nav-item dropdown message-dropdown theme-text">
                    <div class="">
                        <a class="nav-link dropdown-toggle"><b><?php
                      echo  $diasemana[$diasemana_numero]; ?></b></a>
                    </div>
                </li>
                <li class="nav-item dropdown message-dropdown theme-text mr-4">
                    <div class="">
                        <a class="nav-link dropdown-toggle">
                        <?php $date = date('d-m-Y'); echo $date;?></a>
                    </div>
                </li>
                <li class="nav-item dropdown message-dropdown theme-text">
                    <div class="">
                        <a class="nav-link dropdown-toggle" href="index.php?acao=<?php echo $item11 ?>">Bem-vindo:&nbsp;<b><span style="color: black;"><?php echo $_SESSION['nome_usuario']; ?></span></b></a>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="index.php?acao=<?php echo $item1 ?>" data-active="<?php echo $item1ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="menu <?php echo $item1ativo ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?php echo $item4ativo ?>">
                        <a href="index.php?acao=<?php echo $item4 ?>" data-active="<?php echo $item4ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span>Cargos</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?php echo $item2ativo ?>">
                        <a href="index.php?acao=<?php echo $item2 ?>" data-active="<?php echo $item2ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <span>Colaboradores</span>
                            </div>
                        </a>
                    </li>
                <!--    <li class="menu <?php echo $item3ativo ?>">
                        <a href="index.php?acao=<?php echo $item3 ?>" data-active="<?php echo $item3ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span>Médicos</span>
                            </div>
                        </a>
                    </li> -->
                   
                    
                    <li class="menu <?php echo $item7ativo ?>">
                        <a href="index.php?acao=<?php echo $item7 ?>" data-active="<?php echo $item7ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span>Ausências</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?php echo $item8ativo ?>">
                        <a href="index.php?acao=<?php echo $item8 ?>" data-active="<?php echo $item8ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                <span>Proc. Salário</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu <?php echo $item10ativo ?>">
                        <a href="index.php?acao=<?php echo $item10 ?>" data-active="<?php echo $item10ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                               <span>Usúarios</span>
                           </div>
                       </a>
                   </li>
                    <li class="menu <?php echo $item6ativo ?>">
                        <a href="index.php?acao=<?php echo $item9 ?>" data-active="<?php echo $item9ativo ?>" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                               <span>Horário</span>
                           </div>
                       </a>
                   </li>
               </ul>
               <!-- <div class="shadow-bottom"></div> -->

           </nav>

       </div>
       <!--  END SIDEBAR  -->

       <!--  BEGIN CONTENT AREA  -->
       <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">

                <?php 

                if(@$_GET['acao'] == $item1){
                    include_once($item1.".php"); 
                }elseif(@$_GET['acao'] == $item2){
                    include_once($item2.".php"); 
                }elseif(@$_GET['acao'] == $item3){
                    include_once($item3.".php"); 
                }elseif(@$_GET['acao'] == $item4){
                    include_once($item4.".php");
                }elseif(@$_GET['acao'] == $item6){
                    include_once($item6.".php"); 
                }elseif(@$_GET['acao'] == $item7){
                    include_once($item7.".php");
                }elseif(@$_GET['acao'] == $item8){
                    include_once($item8.".php");
                }elseif(@$_GET['acao'] == $item9){
                    include_once($item9.".php");
                }elseif(@$_GET['acao'] == $item10){
                    include_once($item10.".php");
                }elseif(@$_GET['acao'] == $item11){
                    include_once($item11.".php");
                }else{
                    include_once($item1.".php"); 
                }

                ?>
            </div>

        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">MDigital</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Criado com <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->
<script src="../assets/js/libs/jquery-3.1.1.min.js"></script>
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

<script src="../bootstrap/js/popper.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script> 
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../assets/js/app.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../plugins/fullcalendar/moment.min.js"></script>
<script src="../plugins/flatpickr/flatpickr.js"></script>
<script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="../plugins/fullcalendar/custom-fullcalendar.advance.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="../assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="../plugins/apex/apexcharts.min.js"></script>
<script src="../assets/js/dashboard/dash_1.js"></script> 
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="../plugins/table/datatable/datatables.js"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>
    
<script src="../plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="../plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="../plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="../plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [

                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "mostrando página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Pesquisar...",
               "sLengthMenu": "Resultados :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        } );
    </script>

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel"><b>Sair do Sistema</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D42A2A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text"><h6><b>Caro(a) <?php echo $_SESSION['nome_usuario']; ?></b>, deseja realmente terminar a sessão?</h6></p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger" href="../sair.php">Sim</a>
                <button class="btn btn-dark" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Não</button>
                
            </div>
        </div>
    </div>
</div>

</body>
</html>