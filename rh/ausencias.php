<?php 
$pagina = 'ausencias'; 
$agora = date('Y-m-d');

?>

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
  <div class="widget-content widget-content-area br-6">
    <div class="row btnnovo mt-1">
      <div class="col-md-2 col-sm-12">
        <div class="float-left">
          <a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
          <a href="index.php?acao=<?php echo $pagina ?>&funcao=novo"  type="button" class="btn btn-secondary btn-lg">Marcar</a>
        </div>
      </div>

    <div class="col-md-1 col-sm-12" style="visibility: hidden;">
        <div class="float-left">
          <form method="post">
            <select onChange="submit();" class="form-control form-control-sm" id="exampleFormControlSelect1" name="itens-pagina">

              <?php 

              if(isset($_POST['itens-pagina'])){
                $item_paginado = $_POST['itens-pagina'];
              }elseif(isset($_GET['itens'])){
                $item_paginado = $_GET['itens'];
              }

              ?>

              <option value="<?php echo @$item_paginado ?>"><?php echo @$item_paginado ?> Registros</option>

              <?php if(@$item_paginado != $opcao1){ ?> 
                <option value="<?php echo $opcao1 ?>"><?php echo $opcao1 ?> Registros</option>
              <?php } ?>

              <?php if(@$item_paginado != $opcao2){ ?> 
                <option value="<?php echo $opcao2 ?>"><?php echo $opcao2 ?> Registros</option>
              <?php } ?>

              <?php if(@$item_paginado != $opcao3){ ?> 
                <option value="<?php echo $opcao3 ?>"><?php echo $opcao3 ?> Registros</option>
              <?php } ?>
            </select>
          </form>
        </div>
      </div> 
      <?php 
  //DEFINIR O NUMERO DE ITENS POR PÁGINA
      if(isset($_POST['itens-pagina'])){
        $itens_por_pagina = $_POST['itens-pagina'];
        @$_GET['pagina'] = 0;
      }elseif(isset($_GET['itens'])){
        $itens_por_pagina = $_GET['itens'];
      }
      else{
        $itens_por_pagina = $opcao1;

      }
      ?>
      <div class="col-md-9 col-sm-12">
        <div class="float-right">
          <form id="frm" class="form-inline my-2 my-lg-0" method="post">
            <input type="hidden" id="pag"  name="pag" value="<?php echo @$_GET['pagina'] ?>">

            <input type="hidden" id="itens"  name="itens" value="<?php echo @$itens_por_pagina; ?>">

            <button style="visibility:hidden;" class="btn btn-outline-secondary btn-sm btn-sm my-2 my-sm-0" id="btnpesquisar" name="btnpesquisar">Pesquisar</button>
            
            <input class="form-control form-control-sm mr-sm-2" type="text" name="txtpesquisar" id="txtpesquisar" placeholder="Pesquisar estado...">

            <input class="form-control form-control-sm mr-sm-2" type="date" name="dataInicial" id="dataInicial" value="<?php echo $agora ?>">

            <input class="form-control form-control-sm" type="date" name="dataFinal" id="dataFinal" value="<?php echo $agora ?>">
          </form>
        </div>
      </div>
    </div> <div id="listar"></div>
  <!--  <div class="table-responsive mb-2" style="margin-top: -48px;">
      <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
        <thead>
          <tr>
            <th>Colaborador</th>
            <th>Tipo de Ausência</th>
            <th>Dia(s)</th>
            <th>Hora(s)</th>
            <th>Estado</th>
            <th class="text-right">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $txtpesquisar = @$_POST['txtpesquisar'];

          if($txtpesquisar == ''){
            $res_o = $pdo->query("SELECT * from ausencias order by id desc");
          }else{
            $txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
            $res_o = $pdo->query("SELECT * from ausencias order by id desc");
          }

          $dados_o = $res_o->fetchAll(PDO::FETCH_ASSOC);

  //TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
          $res_todos = $pdo->query("SELECT * from ausencias order by id desc");
          $dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
          $num_total = count($dados_total);

    //DEFINIR O TOTAL DE PAGINAS
          $num_paginas = ceil($num_total/$itens_por_pagina);


          for ($i=0; $i < count($dados_o); $i++) { 
            foreach ($dados_o[$i] as $key => $value) {

            }
            $id_t = $dados_o[$i]['id']; 
            $colaborador_t = $dados_o[$i]['colaborador'];
            $dt_inicio_t = $dados_o[$i]['dt_inicio'];
            $dt_final_t = $dados_o[$i]['dt_final'];
            $titulo_t = $dados_o[$i]['titulo'];
            $estado_t = $dados_o[$i]['estado'];
            //$data1 = implode('/', array_reverse(explode('-', $dt_inicio_t)));
            //$data2 = implode('/', array_reverse(explode('-', $dt_final_t)));


            // Calcula a diferença em segundos entre as datas
            $diferenca = strtotime($dt_final_t) - strtotime($dt_inicio_t);

            //Calcula a diferença em dias
            $dias = floor($diferenca / (60 * 60 * 24));

           $dt1 = $dt_inicio_t;
           $timestamp = strtotime($dt1);
           $dat1 = date("d-m-Y", $timestamp);

           $dt2 = $dt_final_t;
           $timestamp = strtotime($dt2);
           $dat2 = date("d-m-Y", $timestamp);

           $dt3 = $dt_final_t;
           $timestamp = strtotime($dt3);
           $dat3 = date("H:i", $timestamp);

           $dt4 = $dt_inicio_t;
           $timestamp = strtotime($dt4);
           $dat4 = date("H:i", $timestamp);


            //Calcula o tempo de upload
            $entrada = $dat4;
            $saida = $dat3;
            $hora1 = explode(":",$entrada);
            $hora2 = explode(":",$saida);
            @$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
            @$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
            $resultado = $acumulador2 - $acumulador1;
            $hora_ponto = floor($resultado / 3600);
            $resultado = $resultado - ($hora_ponto * 3600);
            $min_ponto = floor($resultado / 60);
            $resultado = $resultado - ($min_ponto * 60);
            $secs_ponto = $resultado;
            //Grava na variável resultado final
            $tempo = $hora_ponto.":".$min_ponto.":".$secs_ponto;
             
         

        //BUSCAR O TIPO DE ATENDIMENTO
          $res_med = $pdo->query("SELECT * from colaboradores where id = '$colaborador_t'");
          $dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
          $linhas = count($dados_med);

          if($linhas > 0){

            $nome_c = $dados_med[0]['nome'];  
          }
            ?>
            <tr>
              <td><?php echo $nome_c ?> </td>
              <td><?php echo $titulo_t ?> </td>
              <td><?php echo $dias ?></td>
              <td><?php echo  $tempo ?> </td>
              <td><?php echo $estado_t ?> </td>

              <td class="text-right">
                <a type="button" class="btn btn-sm btn-secondary" title="Editar Dados" href="index.php?acao=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id ?>"><i class="fas fa-pencil-alt"></i></a>
                <a type="button" class="btn btn-sm btn-danger" title="Eliminar Dados" href="index.php?acao=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id ?>"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div> -->
  </div>
</div>
</div>
<!--
MODAL DE CONSULTA
-->

<style>

  .modal {
    padding: 5px !important; // override inline padding-right added from js
    margin-bottom: -20px!important; // override inline padding-right added from js
    float: center!important;
    background-color:#FCFCFC;
  }
  .modal .modal-dialog {
    width: 55%;
    max-width: none;
    height: 100%;
    margin:0 auto;
  }
  .modal .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
    background-color:#FCFCFC;
  }
  .modal .modal-body {
    overflow-y: auto;
  }
</style>
<!--
MODAL REGISTRO DE DADOS
-->
<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <nav class="navbar navbar-dark mb-2">
    <div class="header-container fixed-top">
      <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
          <li class="nav-item theme-logo">
            <a href="">
              <img src="../assets/img/mg.jpg" class="navbar-logo" alt="logo">
            </a>
          </li>
          <li class="nav-item theme-text">
            <a href="" class="nav-link"> MINHA SAÚDE </a>
          </li>
        </ul>


        <ul class="navbar-item flex-row ml-md-auto mr-4">
          <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
            <div id="mensagem" class="mensagem"></div>
          </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto mr-4">
          <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
            <a class="testo mt-2"><i class="fas fa-folder-plus"></i><b>Marcar Ausência</b></a>
          </li>
        </ul>
      </header>
    </div>
  </nav>
  <br>
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content mt-4">
      <div class="modal-body mt-4">
        <form method="post" id="frm">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Seleccionar Tipo de Ausência</label>
            <select class="form-control" id="titulo" name="titulo">

              <?php 
              if(@$_GET['funcao'] == 'editar'){
                echo '<option value="'.$titulo.'">'.$titulo.'</option>';
              }
              ?>
              <?php if($titulo != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
              <?php if($titulo != 'Falta') echo '<option value="Falta">Falta</option>'; ?>

              <?php if($titulo != 'Férias') echo '<option value="Férias">Férias</option>'; ?>

              <?php if($titulo != 'Doença') echo '<option value="Doença">Doença</option>'; ?>

              <?php if($titulo != 'Outros') echo '<option value="Outros">Outros</option>'; ?>
            </select>
          </div>
          <br>
          <div class="form-group">

            <input type="hidden" id="id"  name="id"  required>
            
            <label for="exampleFormControlSelect1">Seleccionar Colaborador</label>
            <select class="form-control" id="colaborador" name="colaborador">



              <?php 



                //TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
              $res = $pdo->query("SELECT * from colaboradores order by nome asc");
              $dados = $res->fetchAll(PDO::FETCH_ASSOC);

              for ($i=0; $i < count($dados); $i++) { 
                foreach ($dados[$i] as $key => $value) {
                }

                $id = $dados[$i]['id']; 
                $nome = $dados[$i]['nome'];



                echo '<option value="'.$id.'">'.$nome.' </option>';


              }

              ?>
            </select>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Data Inicio</label>
              <input class="form-control form-control-sm mr-sm-2" type="datetime-local" name="dt_inicio" id="dt_inicio" value="<?php echo @$dt_inicio ?>">
            </div>

            <div class="col-md-6">
              <label for="exampleFormControlSelect1">Data Final</label>
              <input class="form-control form-control-sm mr-sm-2" type="datetime-local" name="dt_final" id="dt_final" value="<?php echo @$dt_final ?>">
            </div>
          <div class="form-group col-md-12 mt-4">
              
              <label for="exampleFormControlSelect1">Alterar Estado</label>
            <select class="form-control" id="estado" name="estado">

              <?php 
              if(@$_GET['funcao'] == 'editar'){
                echo '<option value="'.$estado.'">'.$estado.'</option>';
              }
              ?>
              <?php if($estado != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
              <?php if($estado != 'Aprovado') echo '<option value="Aprovado">Aprovado</option>'; ?>

              <?php if($estado != 'Pendente') echo '<option value="Pendente">Pendente</option>'; ?>

              <?php if($estado != 'Em Revisão') echo '<option value="Em Revisão">Em Revisão</option>'; ?>

              <?php if($estado != 'Recusado') echo '<option value="Recusado">Recusado</option>'; ?>
            </select>
            </div>
            <input type="hidden" id="data" name="data" value="<?php echo @$data ?>">
          </div>
        </div>
        <div class="modal-footer">  
          <button id="btn-salvar" name="btn-salvar" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;Marcar</button>&nbsp;&nbsp;ou&nbsp;&nbsp;
          <button onClick="location.href='index.php?acao=ausencias'" id="btn-fechar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!--
MODAL CONSULTA DE DADOS
-->
<?php 
if (@$_GET['funcao'] == 'consulta' && @$item_paginado == '') {
  $id = $_GET['id'];

//Pesquisa dados a ser registados na DB
  $res = $pdo->query("SELECT * from ausencias where id = '$id'");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  $estado = $dados[0]['estado'];

  ?>
  <div class="modal" id="modalconsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <nav class="navbar navbar-dark mb-2">
    <div class="header-container fixed-top">
      <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
          <li class="nav-item theme-logo">
            <a href="">
              <img src="../assets/img/mg.jpg" class="navbar-logo" alt="logo">
            </a>
          </li>
          <li class="nav-item theme-text">
            <a href="" class="nav-link"> MINHA SAÚDE </a>
          </li>
        </ul>


        <ul class="navbar-item flex-row ml-md-auto mr-4">
          <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
            <div id="mensagem" class="mensagem"></div>
          </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto mr-4">
          <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
            <a class="testo mt-2"><i class="fas fa-folder-plus"></i><b>ALTERAR ESTADO</b></a>
          </li>
        </ul>
      </header>
    </div>
  </nav>
  <br>
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content mt-4">
        <div class="modal-body mt-4">
          <form method="post">
            <div class="form-group col-md-12">
              <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
              <label for="exampleFormControlSelect1">Alterar Estado</label>
            <select class="form-control" id="estado" name="estado">

              <?php 
              if(@$_GET['funcao'] == 'consulta'){
                echo '<option value="'.$estado.'">'.$estado.'</option>';
              }
              ?>
              <?php if($estado != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
              <?php if($estado != 'Aprovado') echo '<option value="Aprovado">Aprovado</option>'; ?>

              <?php if($estado != 'Pendente') echo '<option value="Pendente">Pendente</option>'; ?>

              <?php if($estado != 'Em Revisão') echo '<option value="Em Revisão">Em Revisão</option>'; ?>

              <?php if($estado != 'Recusado') echo '<option value="Recusado">Recusado</option>'; ?>
            </select>
            </div>
          </div>
          <div class="modal-footer">
            <button id="editar" name="editar" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;Confirmar</button>&nbsp;&nbsp;ou&nbsp;&nbsp;
            <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<!--
CÓDIGO BOTÃO ELIMINAR
-->
<?php 
if (@$_GET['funcao'] == 'excluir' && @$item_paginado == '') { 

  $id = $_GET['id'];

  ?>

  <div class="modal" id="ModalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <nav class="navbar navbar-dark mb-2">
      <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

          <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
              <a href="">
                <img src="../assets/img/mg.jpg" class="navbar-logo" alt="logo">
              </a>
            </li>
            <li class="nav-item theme-text">
              <a href="" class="nav-link mr-1"> MINHA SAÚDE </a>
            </li>
          </ul>


          <ul class="navbar-item flex-row ml-md-auto mr-4">
            <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
              <div id="mensagem" class="mensagem"></div>
            </li>
          </ul>

          <ul class="navbar-item flex-row ml-md-auto mr-4">
            <li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
              <a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>Deseja realmente EXCLUIR?</b></a>
            </li>
          </ul>
        </header>
      </div>
    </nav>
    <br>
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-body mt-4">
          
          <p>Selecione abaixo <b>Excluir</b> se estiver pronto para eliminar o registro</p>
          <br>
          <p>
            Ao apagar o resgistro, vai perder todos os dados. Essa ação é irreversível. Não poderá restaurar os daods, mesmo que a apague por acidente.
          </p>
        </div>
        <div class="modal-footer" style="margin-top: 70px;">
          <form method="post">
            <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
            
            <button class="btn btn-danger" name="btn-excluir" id="btn-excluir" type="button" data-dismiss="modal"><i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Excluir</button>
          </form>
          <button class="btn btn-dark" id="btn-excluir-dados" name="btn-excluir-dados" type="button" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php } ?>


<?php 
if (@$_GET['funcao'] == 'novo' && @$item_paginado == '') {?>
  <script>$('#btn-novo').click();</script>
<?php } ?>

<!--
CÓDIGO BOTÃO EDITAR
-->
<?php 
if (@$_GET['funcao'] == 'editar' && @$item_paginado == '') { ?>

  <script>$('#btn-novo').click();</script>
<?php } ?>



<!--
Ajax para adição de dados
-->
<script type="text/javascript">
  $(document).ready(function(){
    var pag = "<?=$pagina?>";
    $('#btn-salvar').click(function(event){
      event.preventDefault();
      //window.alert('Teste');
      $.ajax({
        url: pag + "/inserir.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){
          $('#mensagem').removeClass()
          if(mensagem == 'Registrado com sucesso'){

            $('#mensagem').addClass('mensagem-sucesso')
            $('#colaborador').val('')

            $('#txtpesquisar').val('')
            $('#btnpesquisar').click();
            //$('#btn-fechar').click();

          }else{
            $('#mensagem').addClass('mensagem-erro')
          }
          
          $('#mensagem').text(mensagem)
        },
      })
    })
  })
</script>


<!--AJAX PARA EDIÇÃO DOS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){
    var pag = "<?=$pagina?>";
    $('#editar').click(function(event){
      event.preventDefault();
      
      $.ajax({
        url: pag + "/editar.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#mensagem').removeClass()

          if(mensagem == 'Atualizado com sucesso'){

            $('#mensagem').addClass('mensagem-sucesso')

            
            $('#txtpesquisar').val('')
            $('#btnpesquisar').click();

            $('#btn-fechar').click();




          }else{

            $('#mensagem').addClass('mensagem-erro')
          }
          
          $('#mensagem').text(mensagem)

        },
        
      })
    })
  })
</script>


<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){   
    var pag = "<?=$pagina?>";
    $.ajax({
      url: pag + "/listar.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar').html(result)

      },

      
    })
  })
</script>

<!--AJAX PARA BUSCAR OS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){

    var pag = "<?=$pagina?>";
    $('#btnpesquisar').click(function(event){
      event.preventDefault(); 
      
      $.ajax({
        url: pag + "/listar.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "html",
        success: function(result){
          $('#listar').html(result)
          
        },
        

      })

    })

    
  })
</script>



<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){
    var pag = "<?=$pagina?>";
    $('#btn-excluir').click(function(event){
      event.preventDefault();
      
      $.ajax({
        url: pag + "/excluir.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#txtpesquisar').val('')
          $('#btnpesquisar').click();
          $('#btn-excluir-dados').click();

        },
        
      })
    })
  })
</script>

<!--
Ajax para Pesquisar de dados
-->
<script type="text/javascript">
  $('#txtpesquisar').keyup(function(){
    $('#btnpesquisar').click();
  })
</script>

<!--AJAX PARA BUSCAR OS DADOS PELA DATA INICIAL -->
<script type="text/javascript">
  $('#dataInicial').change(function(){
    $('#btnpesquisar').click();
  })
</script>

<!--AJAX PARA BUSCAR OS DADOS PELA DATA FINAL -->
<script type="text/javascript">
  $('#dataFinal').change(function(){
    $('#btnpesquisar').click();
  })
</script>
<!--
SCRIPT PARA CHAMAR MODAL EDITAR
-->
<script>$("#modalconsulta").modal("show");</script>
<script>$("#ModalConsulta").modal("show");</script>
<!--
CÓDIGO BOTÃO NOVO
-->