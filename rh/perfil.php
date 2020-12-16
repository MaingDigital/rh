<?php $pagina = 'perfil'; 

@session_start();
?>


<div class="layout-px-spacing">

	<div class="row layout-spacing">

		<!-- Content -->
		<div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
			<?php 
			$email_func = $_SESSION['email_usuario'];


			$res_espec = $pdo->query("SELECT * from colaboradores where email = '$email_func'");
			$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

			for ($i=0; $i < count($dados_espec); $i++) { 
				foreach ($dados_espec[$i] as $key => $value) {
				}
				$col_id = $dados_espec[$i]['id'];
				$col_nome = $dados_espec[$i]['nome'];
				$col_nif = $dados_espec[$i]['nif'];
				$col_bilhete = $dados_espec[$i]['bilhete'];
				$col_cargo = $dados_espec[$i]['cargo'];
				$col_morada = $dados_espec[$i]['morada'];
				$col_email_pro = $dados_espec[$i]['email_pro'];
				$col_telefone2 = $dados_espec[$i]['telefone2'];
				$col_num = $dados_espec[$i]['codigo_colaborador'];
				$data_nascimento = $dados_espec[$i]['data_nascimento'];
				$foto = $dados_espec[$i]['foto'];
				$obs = $dados_espec[$i]['obs'];
				$dt11 = implode('/', array_reverse(explode('-', $data_nascimento)));

          //echo "<script language='javascript'>window.alert('$col_num'); </script>";
          //BUSCAR O TIPO DE ATENDIMENTO
				$res_med = $pdo->query("SELECT * from ausencias where colaborador = '$col_id'");
				$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
				$linhas = count($dados_med);

				if($linhas > 0){
					$col_id = $dados_med[0]['id'];
					$data1 = $dados_med[0]['dt_inicio'];
					$data2 = $dados_med[0]['dt_final'];

					$data_inicial = $data1;
					$data_final = $data2;

            // Calcula a diferença em segundos entre as datas
					$diferenca = strtotime($data_final) - strtotime($data_inicial);

            //Calcula a diferença em dias
					$dias = floor($diferenca / (60 * 60 * 24));

					$total_ferias = '22';
					$ferias_marcadas = $dias;
					$dias_restantes = $total_ferias - $ferias_marcadas;

				}
				?>

				<input type="hidden" id="id" name="id" value="<?php echo @$col_id ?>">
				<input type="hidden" id="nif_antigo" name="nif_antigo" value="<?php echo @$func_nif ?>">

				<div class="user-profile layout-spacing">
					<div class="widget-content widget-content-area">
						<div class="d-flex justify-content-between">
							<h3 class="">Meu Perfil</h3>
							<a type="button" data-toggle="modal" data-target="#modal" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
						</div>
						<div class="text-center user-info">
							<a href="img/<?php echo $foto ?>" target="_blank"><img src="img/<?php echo $foto ?>" width="160px"></a><br>
							<a type="button" data-toggle="modal" data-target="#modal" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg><h6>Altar Foto</h6></a><br><br>
							<style rel="stylesheet" type="text/css">

								h1, h2, h3, h4, h5, h6 {

									text-transform: uppercase;

								}

							</style>
							<p class="mt-2 mb-2"><b><h5><?php echo @$col_nome ?></h5></b></p>

							<h6><b><?php echo $col_num ?></b></h6>
						</div>
						<div class="user-info-list">

							<div class="">
								<ul class="contacts-block list-unstyled">
									<li class="contacts-block__item mt-4">
										<h6><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg><?php echo @$col_cargo ?></h6> 
									</li>
									<li class="contacts-block__item mt-4">
										<h6><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><?php echo $dt11 ?></h6>
									</li>
									<li class="contacts-block__item mt-4">
										<h6><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg><?php echo $col_morada ?></h6>
									</li>
									<li class="contacts-block__item mt-4">
										<h6><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><?php echo $col_email_pro ?></h6>
									</li>
									<li class="contacts-block__item mt-4">
										<h6><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><?php echo $col_telefone2 ?></h6> 
									</li>

								</ul>
							</div>                                    
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
			<div class="bio layout-spacing ">

				<div class="widget-content widget-content-area">
					<div class="d-flex justify-content-between">
						<h3 class="">Biografia</h3>
						<a type="button" data-toggle="modal" data-target="#biografia" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					</div>
					
					<p style="text-align: justify;"><?php echo $obs ?></p>

					<br><br>
					<div class="bio-skill-box">

						<div class="row">

							<div class="col-4 col-xl-4 col-lg-4 mb-xl-5 mb-5 ">

								<div class="d-flex b-skills">
									<div>
									</div>
									<div class="">
										<h5>Total de Férias</h5>
										<p><?php echo $total_ferias ?></p>
									</div>
								</div>

							</div>

							<div class="col-4 col-xl-4 col-lg-4 mb-xl-0 mb-5 ">

								<div class="d-flex b-skills">
									<div>
									</div>
									<div class="">
										<h5>Férias Marcadas</h5>
										<p><?php echo $ferias_marcadas ?></p>
									</div>
								</div>

							</div>

							<div class="col-4 col-xl-4 col-lg-4 mb-xl-0 mb-0 ">

								<div class="d-flex b-skills">
									<div>
									</div>
									<div class="">
										<h5>Dias Restantes</h5>
										<p><?php echo $dias_restantes ?></p>
									</div>
								</div>

							</div>

						</div>

					</div>

				</div>                                
			</div>

		</div>

	</div>
</div>

<input class="form-control form-control-sm mr-sm-2" type="hidden" name="txtpesquisar" id="txtpesquisar" placeholder="Nome ou nif">
<button style="visibility:hidden;" class="btn btn-outline-secondary btn-sm btn-sm my-2 my-sm-0" id="btnpesquisar" name="btnpesquisar">Pesquisar</button>

<div class="modal" id="biografia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
						<a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>Alterar Biografia</b></a>
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

					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="exampleFormControlSelect1">MINHA BIOGRAFIA</label>
							<textarea class="form-control" id="obs" name="obs" rows="20" placeholder="Mais Info"><?php echo @$obs ?></textarea>
						</div>
					</div>
				</div>
				<input type="hidden" id="nif" name="nif" value="<?php echo @$col_nif ?>">
				<div class="modal-footer" style="margin-top: 70px;">
					<button onClick="location.href='index.php?acao=perfil'" class="btn btn-secondary" name="btn-bio" id="btn-bio" type="button"><i class="fas fa-save"></i>&nbsp;&nbsp;Alterar</button>
				</form>
				<button class="btn btn-dark" id="btn-fechar" name="btn-fechar" type="button" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancelar</button>
			</div>
		</div>
	</div>
</div>
</div>

<!--<?php 

		//@$obs = $_POST['obs'];
		//@$nif = $_POST['nif'];
		//$res = $pdo->prepare("UPDATE colaboradores SET obs = :obs where nif = :nif");

		//$res->bindValue(":obs", $obs);
		//$res->bindValue(":nif", $col_nif);

		//$res->execute();

?>-->

<!-- Modal -->

<style>

	.modal {
		padding: 5px !important; // override inline padding-right added from js
		margin-bottom: -20px!important; // override inline padding-right added from js
		float: center!important;
		background-color:#FCFCFC;
	}
	.modal .modal-dialog {
		width: 60%;
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
						<a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>Alteração da Senha</b></a>
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

					<div class="form-group">
						<label for="exampleFormControlInput1">Inserir Nova senha</label>
						<input type="password" class="form-control" id="" placeholder="Nova Senha" name="senha" >
					</div>

					<div class="form-group">
						<label for="exampleFormControlInput1">Confirmar nova senha</label>
						<input type="password" class="form-control" id="" placeholder="Confirmar a Senha" name="confirmar-senha">
					</div>
				</div>
				<div class="modal-footer" style="margin-top: 70px;">
					<button class="btn btn-secondary" type="submit" name="btn-senha" type="button"><i class="fas fa-save"></i>&nbsp;&nbsp;Alterar</button>
				</form>
				<button class="btn btn-dark" id="btn-excluir-dados" name="btn-excluir-dados" type="button" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancelar</button>
			</div>
		</div>
	</div>
</div>
</div>


<!--CÓDIGO DO BOTÃO SALVAR -->
<?php 
if(isset($_POST['btn-senha'])){
	$senha = $_POST['senha'];
	$confirmar_senha = $_POST['confirmar-senha'];



	$email_usuario = $_SESSION['email_usuario'];


	$res_usuario = $pdo->query("SELECT * from usuarios where usuario = '$email_usuario'");
	$dados_usuario = $res_usuario->fetchAll(PDO::FETCH_ASSOC);
	$id_adm = $dados_usuario[0]['id'];  



	if($senha == $confirmar_senha){


		$res = $pdo->prepare("UPDATE usuarios SET senha = :senha, senha_original = :senha_original where id = :id");

		$res->bindValue(":senha", md5($senha));
		$res->bindValue(":senha_original", $senha);
		$res->bindValue(":id", $id_adm);

		$res->execute();


		echo "<script language='javascript'>window.location='../index.php'; </script>";

	}else{
		echo "<script language='javascript'>window.alert('As senhas não coincidem!!'); </script>";
	}



}

?>


<!--AJAX PARA EDIÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-bio').click(function(event){
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
<!--
Ajax para Pesquisar de dados
-->
<script type="text/javascript">
	$('#txtpesquisar').change(function(){
		$('#btnpesquisar').click();
	})
</script>