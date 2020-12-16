<?php $pagina = 'turnos'; ?>

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">
		<div class="row btnnovo mt-1">
			<div class="col-md-2 col-sm-12">
				<div class="float-left" style="position: relative; z-index: 100;">
					<a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
					<a href="index.php?acao=<?php echo $pagina ?>&funcao=novo"  type="button" class="btn btn-secondary btn-lg">Inserir Novo</a>
				</div>
			</div>
		</div>
		<input class="form-control form-control-sm mr-sm-2" type="hidden" name="txtpesquisar" id="txtpesquisar" placeholder="Nome ou nif">
		<button style="visibility:hidden;" class="btn btn-outline-secondary btn-sm btn-sm my-2 my-sm-0" id="btnpesquisar" name="btnpesquisar">Pesquisar</button>
		<div class="table-responsive mb-2" style="margin-top: -48px;">
			<div id="listar"></div>
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
							<img src="../assets/img/logi1.png" class="navbar-logo" alt="logo" style="width: 35px; height: 20px;">
						</a>
					</li>
					<li class="nav-item theme-text">
						<a href="" class="nav-link"> MAINGUE RH </a>
					</li>
				</ul>


				<ul class="navbar-item flex-row ml-md-auto mr-4">
					<li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
						<div id="mensagem" class="mensagem"></div>
					</li>
				</ul>

				<ul class="navbar-item flex-row ml-md-auto mr-4">
					<li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
						<a class="testo mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>&ensp;&ensp;<b>
							<?php if(@$_GET['funcao'] == 'editar'){

								$nome_botão = 'Editar';
								$id_reg = $_GET['id'];

					//BUSCAR DADOS DO REGISTRO A SER EDITADO
								$res = $pdo->query("select * from turnos where id = '$id_reg'");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);
								$entrada = $dados[0]['entrada'];
								$saida = $dados[0]['saida'];
								
								echo 'Edição de Turnos';
							}else{
								$nome_botão = 'Salvar';
								echo 'Registro de Turnos';
							} ?>
						</b></a>
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
					<div class="form-row">
						<input type="hidden" id="id" name="id" value="<?php echo @$id_reg ?>">
						<input type="hidden" id="campo_antigo" name="campo_antigo" value="<?php echo @$cargo ?>">

						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">Entrada</label>
							<input type="time" class="form-control" id="entrada" name="entrada" placeholder="" value="<?php echo @$entrada ?>" required>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">Saída</label>
							<input type="time" class="form-control" id="saida" name="saida" placeholder="" value="<?php echo @$saida ?>" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">	
					<button id="<?php echo $nome_botão ?>" name="<?php echo $nome_botão ?>" class="btn btn-secondary
						"><i class="far fa-save"></i>&nbsp;&nbsp;<?php echo $nome_botão ?></button>&nbsp; ou &nbsp;
						<button id="btn-fechar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
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
	$res = $pdo->query("SELECT * from cargos where id = '$id'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$cargo = $dados[0]['cargo'];
	?>
	<div class="modal fade" id="modalconsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<nav class="navbar navbar-dark mb-2">
			<img src="../img/logos.png" style="width: 220; float: left; margin-bottom: -8">
			<a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>CONSULTA DE DADOS</b></a>
		</nav>
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-body mt-4">
					<form method="post">
						<div class="form-group col-md-12">
							<label class="col-form-label">Cargo</label>
							<input type="text" readonly class="form-control" id="cargo" name="cargo" placeholder="Cargo" value="<?php echo $cargo ?>">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
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
							<img src="../assets/img/logi1.png" class="navbar-logo" alt="logo" style="width: 35px; height: 20px;">
						</a>
						</li>
						<li class="nav-item theme-text">
							<a href="" class="nav-link mr-1"> MAINGUE RH </a>
						</li>
					</ul>


					<ul class="navbar-item flex-row ml-md-auto mr-4">
						<li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
							<div id="mensagem" class="mensagem"></div>
						</li>
					</ul>

					<ul class="navbar-item flex-row ml-md-auto mr-4">
						<li title="Definições do Sistema" class="nav-item dropdown message-dropdown theme-text">
							<a class="testo mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>&nbsp;<b>Deseja realmente EXCLUIR?</b></a>
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
		$('#Salvar').click(function(event){
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
						$('#entrada').val('')

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
		$('#Editar').click(function(event){
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
<!--
SCRIPT PARA CHAMAR MODAL EDITAR
-->
<script>$("#modalconsulta").modal("show");</script>
<script>$("#ModalConsulta").modal("show");</script>
<!--
CÓDIGO BOTÃO NOVO
-->