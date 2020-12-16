<?php $pagina = 'medicos'; ?>
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">
		<div class="row btnnovo mt-1">
			<div class="col-md-2 col-sm-12">
				<div class="float-left">
					<a id="btn-novo" data-toggle="modal" data-target="#ModalMedicos"></a>
					<a href="index.php?acao=<?php echo $pagina ?>&funcao=novo"  type="button" class="btn btn-secondary btn-lg">Novo Médico</a>
				</div>
			</div>

			<div class="col-md-4 col-sm-12">
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
			<div class="col-md-6 col-sm-12">
				<div class="float-right">
					<form id="frm" class="form-inline my-2 my-lg-0" method="post">

						<input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

						<input type="hidden" id="itens"  name="itens" value="<?php echo @$itens_por_pagina; ?>">
						<button style="visibility:hidden;" class="btn btn-outline-secondary btn-sm btn-sm my-2 my-sm-0" id="btnpesquisar" name="btnpesquisar">Pesquisar</button>


						<input class="form-control form-control-sm" type="search" placeholder="Pesquisar..." aria-label="Search" name="txtpesquisar" id="txtpesquisar">
					</form>
				</div>
			</div>
		</div>
		<div id="listar"></div>
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
		width: 70%;
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
<div class="modal" id="ModalMedicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
						<a class="testo mt-2"><i class="fas fa-folder-plus"></i><b>
							<?php if (@$_GET['funcao'] == 'editar') {
								$nome_botão = 'Editar';
								$id_reg = $_GET['id'];

						//Pesquisa dados a ser registados na DB
								$res = $pdo->query("SELECT * from medicos where id = '$id_reg' ");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								$nome_medico = $dados[0]['nome'];
								$cod_medico = $dados[0]['cod_med'];
								$amb_medico = $dados[0]['num_ambulatorio'];
								$esp_medico = $dados[0]['especialidade'];
								$cedula_medico = $dados[0]['num_cedula'];
								$turno_medico = $dados[0]['turno'];
								$info_medico = $dados[0]['info'];
								$email = $dados[0]['email'];

								echo 'Edição de Médico';

							}else{
								$nome_botão = 'Salvar';
								echo 'Registro de Médico';
							} ?>

						</b></a>
					</li>
				</ul>
			</header>
		</div>
	</nav>
	<br>
	<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-body mt-4">
				<form method="post">
					<div class="form-row mt-4">
						<input type="hidden" id="id" name="id" value="<?php echo @$id_reg ?>">
						<input type="hidden" id="cod_med_antigo" name="cod_med_antigo" value="<?php echo @$cod_medico ?>">
						<div class="form-group col-md-6">
							<label for="exampleFormControlSelect1">Nome</label>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Médico" value="<?php echo @$nome_medico ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="exampleFormControlSelect1">Código do Médico Interno</label>
							<input type="text" class="form-control" id="cod_med" name="cod_med" placeholder="Código do médico" value="<?php echo @$cod_medico ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="exampleFormControlSelect1">Nº de Ambulatório</label>
							<input type="text" class="form-control" id="num_ambulatorio" name="num_ambulatorio" placeholder="Nº de Ambulatório" value="<?php echo @$amb_medico ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlSelect1">Especialidade</label>
							<select class="form-control" id="especialidade" name="especialidade" id="especialidade">

								<?php

							//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
								if(@$_GET['funcao'] == 'editar'){

									$res_espec = $pdo->query("SELECT * from especializacoes where id = '$esp_medico'");
									$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

									for ($i=0; $i < count($dados_espec); $i++) { 
										foreach ($dados_espec[$i] as $key => $value) {
										}

										$id_espec = $dados_espec[$i]['id'];	
										$nome_espec = $dados_espec[$i]['nome'];

									}


									echo '<option value="'.$id_espec.'">'.$nome_espec.'</option>';
								}



								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
								$res = $pdo->query("SELECT * from especializacoes order by nome asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id = $dados[$i]['id'];	
									$nome = $dados[$i]['nome'];

									if($nome_espec != $nome){
										echo '<option value="'.$id.'">'.$nome.'</option>';
									}

								}
								?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="exampleFormControlSelect1">Nº de Cédula da Ordem</label>
							<input type="text" class="form-control" id="num_cedula" name="num_cedula" placeholder="Nº de Cédula" value="<?php echo @$cedula_medico ?>">
						</div>
						<div class="form-group col-md-3 col-sm-12">
							<label for="exampleFormControlSelect1">Turno</label>
							<select class="form-control" id="turno" name="turno">

								<?php 
								if(@$_GET['funcao'] == 'editar'){
									echo '<option value="'.$turno_medico.'">'.$turno_medico.'</option>';
								}
								?>

								<?php if($turno_medico != 'Manhã') echo '<option value="Manhã">Manhã</option>'; ?>

								<?php if($turno_medico != 'Tarde') echo '<option value="Tarde">Tarde</option>'; ?>

								<?php if($turno_medico != 'Noite') echo '<option value="Noite">Noite</option>'; ?>
							</select>

						</div>
						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">E-mail</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo @$email ?>">
						</div>
						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">Mais Informações</label>
							<textarea class="form-control" id="info" name="info" rows="10" placeholder="Mais Info"><?php echo @$info_medico ?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">	
					<button id="<?php echo $nome_botão ?>" name="<?php echo $nome_botão ?>" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;<?php echo $nome_botão ?></button>&nbsp; ou &nbsp;
					<button id="btn-fechar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
				</div>

			</form>
		</div>
	</div>
</div>
</div>


<!--
MODAL CONSULTA DE DADOS
-->
<?php 
if (@$_GET['func'] == 'consulta') {
	$id_reg = $_GET['id'];

	//Pesquisa dados a ser registados na DB
	$res = $pdo->query("SELECT * from medicos where id = '$id_reg' ");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	$nome_medico = $dados[0]['nome'];
	$cod_medico = $dados[0]['cod_med'];
	$amb_medico = $dados[0]['num_ambulatorio'];
	$esp_medico = $dados[0]['especialidade'];
	$cedula_medico = $dados[0]['num_cedula'];
	$turno_medico = $dados[0]['turno'];
	$info_medico = $dados[0]['info'];
	$email = $dados[0]['email'];

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
							<a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>CONSULTA DE DADOS</b></a>
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
							<input type="hidden" id="cod_med_antigo" name="cod_med_antigo" value="<?php echo @$cod_medico ?>">
							<div class="form-group col-md-6">
								<label for="exampleFormControlSelect1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Médico" value="<?php echo @$nome_medico ?>" disabled>
							</div>
							<div class="form-group col-md-3">
								<label for="exampleFormControlSelect1">Código Interno do Médico</label>
								<input type="text" class="form-control" id="cod_med" name="cod_med" placeholder="Código do médico" value="<?php echo @$cod_medico ?>" disabled>
							</div>
							<div class="form-group col-md-3">
								<label for="exampleFormControlSelect1">Nº de Ambulatório</label>
								<input type="text" class="form-control" id="num_ambulatorio" name="num_ambulatorio" placeholder="Nº de Ambulatório" value="<?php echo @$amb_medico ?>" disabled>
							</div>
							<div class="form-group col-md-6">
								<label for="exampleFormControlSelect1">Especialidade</label>
								<select class="form-control" id="especialidade" name="especialidade" id="especialidade" disabled>


									<?php

								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
									if(@$_GET['func'] == 'consulta'){

										$res_espec = $pdo->query("SELECT * from especializacoes where id = '$esp_medico'");
										$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

										for ($i=0; $i < count($dados_espec); $i++) { 
											foreach ($dados_espec[$i] as $key => $value) {
											}

											$id_espec = $dados_espec[$i]['id'];	
											$nome_espec = $dados_espec[$i]['nome'];

										}


										echo '<option value="'.$id_espec.'">'.$nome_espec.'</option>';
									}



								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
									$res = $pdo->query("SELECT * from especializacoes order by nome asc");
									$dados = $res->fetchAll(PDO::FETCH_ASSOC);

									for ($i=0; $i < count($dados); $i++) { 
										foreach ($dados[$i] as $key => $value) {
										}

										$id = $dados[$i]['id'];	
										$nome = $dados[$i]['nome'];

										if($nome_espec != $nome){
											echo '<option value="'.$id.'">'.$nome.'</option>';
										}


									}
									?>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="exampleFormControlSelect1">Nº de Cédula da Ordem</label>
								<input type="text" class="form-control" id="num_cedula" name="num_cedula" placeholder="Nº de Cédula" value="<?php echo @$cedula_medico ?>" disabled>
							</div>
							<div class="form-group col-md-3 col-sm-12">
								<label for="exampleFormControlSelect1">Turno</label>
								<select class="form-control" id="turno" name="turno" disabled>

									<?php 
									if(@$_GET['func'] == 'consulta'){
										echo '<option value="'.$turno_medico.'">'.$turno_medico.'</option>';
									}
									?>

									<?php if($turno_medico != 'Manhã') echo '<option value="Manhã">Manhã</option>'; ?>

									<?php if($turno_medico != 'Tarde') echo '<option value="Tarde">Tarde</option>'; ?>

									<?php if($turno_medico != 'Noite') echo '<option value="Noite">Noite</option>'; ?>
								</select>

							</div>
							<div class="form-group col-md-12">
								<label for="exampleFormControlSelect1">E-mail</label>
								<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo @$email ?>" disabled>
							</div>
							<div class="form-group col-md-12">
								<label for="exampleFormControlSelect1">Mais Informações</label>
								<textarea class="form-control" id="info" name="info" rows="10" placeholder="Mais Info" disabled><?php echo @$info_medico ?></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer">	
						<button id="btn-fechar" type="button" class="btn btn-dar" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
					</div>
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
					<input type="hidden" id="nome" name="nome" value="<?php echo @$nome ?>">
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
						$('#cod_med').val('')
						$('#num_ambulatorio').val('')
						$('#especialidade').val('')
						$('#num_cedula').val('')
						$('#turno').val('')
						$('#email').val('')
						$('#info').val('')

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
<script>$("#ModalConsulta").modal("show");</script>
<script>$("#ModalEliminar").modal("show");</script>
<!--
CÓDIGO BOTÃO NOVO
-->

<!--MASCARAS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../js/mascaras.js"></script>