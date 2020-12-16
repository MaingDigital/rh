<?php $pagina = 'usuarios'; ?>

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">

<input class="form-control form-control-sm mr-sm-2" type="hidden" name="txtpesquisar" id="txtpesquisar" placeholder="Nome ou nif">
		<button style="visibility:hidden;" class="btn btn-outline-secondary btn-sm btn-sm my-2 my-sm-0" id="btnpesquisar" name="btnpesquisar">Pesquisar</button>
	<div class="table-responsive mb-2">
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
						<a class="testo mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>&ensp;&ensp;<b>
							<?php if(@$_GET['funcao'] == 'editar'){

								$nome_botão = 'Editar';
								$id_usuario = $_GET['id'];

					//BUSCAR DADOS DO REGISTRO A SER EDITADO
								$res = $pdo->query("select * from usuarios where id = '$id_usuario'");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);
								$nome_usuario = $dados[0]['nome'];
								$email_usuario = $dados[0]['usuario'];
								$senha_usuario = $dados[0]['senha_original'];
								$email_usuario_rec = $dados[0]['usuario'];
								$cargo = $dados[0]['cargo'];


								echo 'Edição de Utilizadores';
							}else{
								$nome_botão = 'Salvar';
								echo 'Registro de Utilizadores';
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
						<input type="hidden" id="id" name="id" value="<?php echo @$id_usuario ?>">
						<input type="hidden" id="email_usuario_rec" name="email_usuario_rec" value="<?php echo @$usuario ?>">

						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">Selecionar o Funcionário</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_usuario ?>" required>
						</div>
						<div class="form-group col-md-4">
							<label for="exampleFormControlSelect1">Utilizador</label>
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Utilizador" value="<?php echo @$email_usuario ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="exampleFormControlSelect1">Senha</label>
							<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha_usuario ?>">
						</div>
						<div class="form-group col-md-4">
							<label for="exampleFormControlSelect1">Cargo</label>
							<select class="form-control" id="cargo" name="cargo">

								<?php 
								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
								if(@$_GET['funcao'] == 'editar'){

									$res_espec = $pdo->query("SELECT * from cargos where cargo = '$cargo'");
									$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

									for ($i=0; $i < count($dados_espec); $i++) { 
										foreach ($dados_espec[$i] as $key => $value) {
										}

										$id_cargo = $dados_espec[$i]['id'];	
										$cargo = $dados_espec[$i]['cargo'];

									}


									echo '<option value="'.$cargo.'">'.$cargo.'</option>';
								}
								


								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
								$res = $pdo->query("SELECT * from cargos order by cargo asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id = $dados[$i]['id'];	
									$cargo = $dados[$i]['cargo'];

									if($cargo1 != $cargo){
										echo '<option value="'.$cargo.'">'.$cargo.'</option>';
									}

									
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">	
					<button onClick="location.href='index.php?acao=usuarios'" id="<?php echo $nome_botão ?>" name="<?php echo $nome_botão ?>" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;<?php echo $nome_botão ?></button>&nbsp; ou &nbsp;
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
	$id_usuario = $_GET['id'];

//Pesquisa dados a ser registados na DB
	$res = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$nome_usuario = $dados[0]['nome'];
	$email_usuario = $dados[0]['usuario'];
	$senha_usuario = $dados[0]['senha_original'];
	$cargo = $dados[0]['cargo'];
	$email_usuario_rec = $dados[0]['usuario'];
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
						<div class="form-row">
							<div class="form-group col-md-12">
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo @$nome_usuario ?>" disabled>
							</div>
							<div class="form-group col-md-4">
								<br>
								<label>Utilizador</label>
								<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Utilizador" value="<?php echo @$email_usuario ?>" disabled>
							</div>
							<div class="form-group col-md-4">
								<br>
								<label>Senha</label>
								<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?php echo @$senha_usuario ?>" disabled>
							</div>
							<div class="form-group col-md-4">
								<br>
								<label>Cargo</label>
								<select class="form-control" id="cargo" name="cargo" disabled="">

									<?php 
								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
									if(@$_GET['funcao'] == 'consulta'){

										$res_espec = $pdo->query("SELECT * from cargos where cargo = '$cargo'");
										$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

										for ($i=0; $i < count($dados_espec); $i++) { 
											foreach ($dados_espec[$i] as $key => $value) {
											}

											$id_cargo = $dados_espec[$i]['id'];	
											$cargo = $dados_espec[$i]['cargo'];

										}


										echo '<option value="'.$cargo.'">'.$cargo.'</option>';
									}
									


								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
									$res = $pdo->query("SELECT * from cargos order by cargo asc");
									$dados = $res->fetchAll(PDO::FETCH_ASSOC);

									for ($i=0; $i < count($dados); $i++) { 
										foreach ($dados[$i] as $key => $value) {
										}

										$id = $dados[$i]['id'];	
										$cargo = $dados[$i]['cargo'];

										if($cargo1 != $cargo){
											echo '<option value="'.$cargo.'">'.$cargo.'</option>';
										}

										
									}
									?>
								</select>
							</div>
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
						<a class="testo mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>&ensp;&ensp;<b>Deseja realmente EXCLUIR?</b></a>
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
						$('#nome').val('')
						$('#usuario').val('')
						$('#senha').val('')
						$('#nivel').val('')

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