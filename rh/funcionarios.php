<?php $pagina = 'funcionarios'; ?>
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">

		<div class="row btnnovo mt-1">
			<div class="col-md-3 col-sm-12">
				<div class="float-left mt-2" style="position: relative; z-index: 100;">
					<a id="btn-novo" data-toggle="modal" data-target="#ModalMedicos"></a>
					<a href="index.php?acao=<?php echo $pagina ?>&funcao=novo"  type="button" class="btn btn-secondary btn-lg">Novo Colaborador</a>
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
		width: 80%;
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

							<?php if (@$_GET['funcao'] == 'editar') {
								$nome_botão = 'Editar';
								$id_reg = $_GET['id'];

			//Pesquisa dados a ser registados na DB
								$res = $pdo->query("SELECT * from colaboradores where id = '$id_reg' ");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								$id_col = $dados[0]['id'];	
								$nome_col = $dados[0]['nome'];
								$data_nascimento_col = $dados[0]['data_nascimento'];
								$idade_col = $dados[0]['idade'];
								$estado_civil = $dados[0]['estado_civil'];
								$nacionalidade = $dados[0]['nacionalidade'];
								$morada_col = $dados[0]['morada'];
								$email_col = $dados[0]['email'];
								$telefone_col = $dados[0]['telefone'];
								$bilhete_col = $dados[0]['bilhete'];
								$nif_col = $dados[0]['nif'];
								$nss_col = $dados[0]['nss'];
								$carta_conducao_col = $dados[0]['carta_conducao'];
								$telefone_emergencia_col = $dados[0]['telefone_emergencia'];
								$nome_emergencia_col = $dados[0]['nome_emergencia'];
								$parentesco_emergencia = $dados[0]['parentesco_emergencia'];
								$grau_ensino = $dados[0]['grau_ensino'];
								$curso_col = $dados[0]['curso'];
								$instituicao_formacao = $dados[0]['instituicao_formacao'];
								$nome_banco_col = $dados[0]['nome_banco'];
								$iban_col = $dados[0]['iban'];
								$bic_swift_col = $dados[0]['bic_swift'];
								$codigo_colaborador = $dados[0]['codigo_colaborador'];
								$telefone2_col = $dados[0]['telefone2'];
								$email_pro_col = $dados[0]['email_pro'];
								$cargo = $dados[0]['cargo'];
								$salario_bruto_col = $dados[0]['salario_bruto'];
								$turno = $dados[0]['turno'];
								$obs_col = $dados[0]['obs'];
								$contrato_col = $dados[0]['contrato'];
								$matricula_veiculo_col = $dados[0]['matricula_veiculo'];
								$dificienca_col = $dados[0]['dificienca'];
								$num_dependentes = $dados[0]['num_dependentes'];
								$sexo = $dados[0]['sexo'];
								$turno = $dados[0]['turno'];

			//$func_nome = $dados[0]['nome'];
			//$func_nif = $dados[0]['nif'];
			//$func_bi = $dados[0]['num_bi'];
			//$func_nasc = $dados[0]['data_nasc'];
			//$func_idade = $dados[0]['idade'];
			//$cargo = $dados[0]['cargo'];
			//$func_salario = $dados[0]['salario'];
			//$func_endereco = $dados[0]['endereco'];
			//$func_email = $dados[0]['email'];
			//$func_telefone = $dados[0]['telefone'];
			//$func_info = $dados[0]['info'];

								echo 'EDIÇÃO DE COLABORADORES';

							}else{
								$nome_botão = 'Salvar';
								echo 'REGISTRO DE COLABORADORES';
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
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">DADOS 1</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">DADOS 2</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">DADOS 3</a>
						</li>
						<li class="nav-item ml-auto mt-2">
							<h6>COLABORADOR Nº <b><?php echo @$codigo_colaborador ?></b></h6>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<br><b>Dados Pessoais</b><hr>
							<div class="form-row">
								<input type="hidden" id="id" name="id" value="<?php echo @$id_reg ?>">
								<input type="hidden" id="nif_antigo" name="nif_antigo" value="<?php echo @$nif_col ?>">
								<input type="hidden" id="codigo_colaborador" name="codigo_colaborador" value="<?php echo @$codigo_colaborador ?>">
								<input type="hidden" class="form-control" id="idade" name="idade" placeholder="Idade" value="<?php echo @$idade ?>" disabled>
								<div class="form-group col-md-6">
									<label for="exampleFormControlSelect1">Nome Completo</label>
									<input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João Paulo" value="<?php echo @$nome_col ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Data de Nascimento</label>
									<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data Nascimento" value="<?php echo @$data_nascimento_col ?>">
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Estado Cívil</label>
									<select class="form-control" id="estado_civil" name="estado_civil">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$estado_civil.'">'.$estado_civil.'</option>';
										}
										?>
										<?php if($estado_civil != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($estado_civil != 'Solteiro(a)') echo '<option value="Solteiro(a)">Solteiro(a)</option>'; ?>

										<?php if($estado_civil != 'Casado(a)') echo '<option value="Casado(a)">Casado(a)</option>'; ?>

										<?php if($estado_civil != 'Viuvo(a)') echo '<option value="Viuvo(a)">Viuvo(a)</option>'; ?>

										<?php if($estado_civil != 'Divorciado') echo '<option value="Divorciado(a)">Divorciado(a)</option>'; ?>

										<?php if($estado_civil != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
									</select>
								</div>
							</div>
							<div class="form-row mt-4">
								<div class="form-group col-md-6">
									<label for="exampleFormControlSelect1">Endereço Completo</label>
									<input type="text" class="form-control" id="morada" name="morada" placeholder="Ex: Rua da Vila Alice" value="<?php echo @$morada_col ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">E-mail Pessoal</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="email@email.com" value="<?php echo @$email_col ?>">
								</div>

								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Telemóvel Pessoal</label>
									<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Contribuinte" value="<?php echo @$telefone_col ?>">
								</div>
							</div>
							<div class="form-row mt-4">
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Nacionalidade</label>
									<select class="form-control" id="nacionalidade" name="nacionalidade">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$nacionalidade.'">'.$nacionalidade.'</option>';
										}
										?>
										<?php if($nacionalidade != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($nacionalidade != 'Angolano') echo '<option value="Angolano">Angolano</option>'; ?>

										<?php if($nacionalidade != 'Chinês') echo '<option value="Chinês">Chinês</option>'; ?>

										<?php if($nacionalidade != 'Brasileiro') echo '<option value="Brasileiro">Brasileiro</option>'; ?>

										<?php if($nacionalidade != 'Sul Africano') echo '<option value="Sul Africano">Sul Africano</option>'; ?>

										<?php if($nacionalidade != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
									</select>

								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Sexo</label>
									<select class="form-control" id="sexo" name="sexo">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$sexo.'">'.$sexo.'</option>';
										}
										?>
										<?php if($sexo != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($sexo != 'Masculino') echo '<option value="Masculino">Masculino</option>'; ?>

										<?php if($sexo != 'Feminino') echo '<option value="Feminino">Feminino</option>'; ?>

										<?php if($sexo != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
									</select>

								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Nº de Bilhete</label>
									<input type="text" class="form-control" id="bilhete" name="bilhete" placeholder="123456789" value="<?php echo @$bilhete_col ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Nº de Contribuinte</label>
									<input type="text" class="form-control" id="nif" name="nif" placeholder="123456789" value="<?php echo @$nif_col ?>">
								</div>
							</div>

							<div class="form-row mt-4">
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Nº de Segurança Social</label>
									<input type="text" class="form-control" id="nss" name="nss" placeholder="123456789" value="<?php echo @$nss_col ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Nº de Carta de Condução</label>
									<input type="text" class="form-control" id="carta_conducao" name="carta_conducao" placeholder="123456789" value="<?php echo @$carta_conducao_col ?>">
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Nº de Dependentes</label>
									<select class="form-control" id="num_dependentes" name="num_dependentes">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$num_dependentes.'">'.$num_dependentes.'</option>';
										}
										?>
										<?php if($num_dependentes != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($num_dependentes != '0') echo '<option value="0">0</option>'; ?>
										<?php if($num_dependentes != '1') echo '<option value="1">1</option>'; ?>
										<?php if($num_dependentes != '2') echo '<option value="2">2</option>'; ?>
										<?php if($num_dependentes != '3') echo '<option value="3">3</option>'; ?>
										<?php if($num_dependentes != '4') echo '<option value="4">4</option>'; ?>
										<?php if($num_dependentes != '5') echo '<option value="5">5</option>'; ?>
										<?php if($num_dependentes != '6') echo '<option value="6">6</option>'; ?>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Dificiênça</label>
									<input type="text" class="form-control" id="dificienca" name="dificienca" placeholder="Dificiênca" value="<?php echo @$dificienca_col ?>">
								</div>
							</div>


						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<br><b>Contacto de Emergência</b>
							<div class="form-row mt-4">
								<div class="form-group col-md-6">
									<label for="exampleFormControlSelect1">Nome Completo</label>
									<input type="text" class="form-control" id="nome_emergencia" name="nome_emergencia" placeholder="Ex: João Paulo" value="<?php echo @$nome_emergencia_col ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Telemóvel </label>
									<input type="text" class="form-control" id="telefone_emergencia" name="telefone_emergencia" placeholder="900000000" value="<?php echo @$telefone_emergencia_col ?>">
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Parentesco</label>
									<select class="form-control" id="parentesco_emergencia" name="parentesco_emergencia">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$parentesco_emergencia.'">'.$parentesco_emergencia.'</option>';
										}
										?>
										<?php if($parentesco_emergencia != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($parentesco_emergencia != 'Marido') echo '<option value="Marido">Marido</option>'; ?>

										<?php if($parentesco_emergencia != 'Mulher') echo '<option value="Mulher">Mulher</option>'; ?>

										<?php if($parentesco_emergencia != 'Pai') echo '<option value="Pai">Pai</option>'; ?>

										<?php if($parentesco_emergencia != 'Mãe') echo '<option value="Mãe">Mãe</option>'; ?>

										<?php if($parentesco_emergencia != 'Filho') echo '<option value="Filho">Filho</option>'; ?>
									</select>
								</div>
							</div>

							<b>Dados Acadêmicos</b>
							<div class="form-row mt-4">
								<div class="form-group col-md-6">
									<label for="exampleFormControlSelect1">Nome da Instituição</label>
									<input type="text" class="form-control" id="instituicao_formacao" name="instituicao_formacao" placeholder="Ex: Instituto Médio Técnico " value="<?php echo @$instituicao_formacao ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">Curso</label>
									<input type="text" class="form-control" id="curso" name="curso" placeholder="Ex: Mecanica" value="<?php echo @$curso_col ?>">
								</div>
								<div class="form-group col-md-3 col-sm-12">
									<label for="exampleFormControlSelect1">Grau de Ensino</label>
									<select class="form-control" id="grau_ensino" name="grau_ensino">

										<?php 
										if(@$_GET['funcao'] == 'editar'){
											echo '<option value="'.$grau_ensino.'">'.$grau_ensino.'</option>';
										}
										?>
										<?php if($grau_ensino != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
										<?php if($grau_ensino != 'Básico') echo '<option value="Básico">Básico</option>'; ?>

										<?php if($grau_ensino != 'Médio') echo '<option value="Médio">Médio</option>'; ?>

										<?php if($grau_ensino != '1º Ciclo Ensino Superior') echo '<option value="1º Ciclo Ensino Superior">1º Ciclo Ensino Superior</option>'; ?>

										<?php if($grau_ensino != '2º Ciclo Ensino Superior') echo '<option value="2º Ciclo Ensino Superior">2º Ciclo Ensino Superior</option>'; ?>

										<?php if($grau_ensino != '3º Ciclo Ensino Superior') echo '<option value="3º Ciclo Ensino Superior">3º Ciclo Ensino Superior</option>'; ?>
									</select>
								</div>
							</div>

							<b>Dados Bancarios</b>
							<div class="form-row mt-4">
								<div class="form-group col-md-6">
									<label for="exampleFormControlSelect1">Nome do Banco</label>
									<input type="text" class="form-control" id="nome_banco" name="nome_banco" placeholder="Ex: Banco da Vila Alice" value="<?php echo @$nome_banco_col ?>" required>
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">IBAN</label>
									<input type="text" class="form-control" id="iban" name="iban" placeholder="AOA000000000000" value="<?php echo @$iban_col ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="exampleFormControlSelect1">BIC SWIFT</label>
									<input type="bic_swift" class="form-control" id="bic_swift" name="bic_swift" placeholder="BTWBNMA" value="<?php echo @$bic_swift_col ?>">
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<br><b>Dados Profissionais</b>
							<div class="form-row mt-4">
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
								<div class="form-group col-md-4">
									<label for="exampleFormControlSelect1">Telefone Profissional</label>
									<input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="9000000000" value="<?php echo @$telefone2_col ?>">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleFormControlSelect1">E-mail Profissional</label>
									<input type="email" class="form-control" id="email_pro" name="email_pro" placeholder="mail@tuaempresa.com" value="<?php echo @$email_pro_col ?>">
								</div>
							</div>
							<div class="form-row mt-4">
								<div class="form-group col-md-2">
									<label for="exampleFormControlSelect1">Salário Bruto</label>
									<input type="text" class="form-control" id="salario_bruto" name="salario_bruto" placeholder="0.000.000" value="<?php echo @$salario_bruto_col ?>" required>
								</div>

								<div class="form-group col-md-2">
									<label for="exampleFormControlSelect1">Turno</label>
									<select class="form-control select2 selec" id="turno" name="turno">

										<?php 
								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
										if(@$_GET['funcao'] == 'editar'){

											$res_especi = $pdo->query("SELECT * from turnos where id = '$id'");
											$dados_especi = $res_especi->fetchAll(PDO::FETCH_ASSOC);

											for ($i=0; $i < count($dados_especi); $i++) { 
												foreach ($dados_especi[$i] as $key => $value) {
												}

												$id_turno = $dados_especi[$i]['id'];	
												$entrada = $dados_especi[$i]['entrada'];

											}


											echo '<option value="'.$id_turno.'">'.$id_turno.'</option>';
										}

								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
										$res = $pdo->query("SELECT * from turnos order by id asc");
										$dados = $res->fetchAll(PDO::FETCH_ASSOC);

										for ($i=0; $i < count($dados); $i++) { 
											foreach ($dados[$i] as $key => $value) {
											}

											$id2 = $dados[$i]['id'];	
											$entrada = $dados[$i]['entrada'];

											if($id21 != $id2){
												echo '<option value="'.$id2.'">'.$id2.'</option>';
											}


										}
										?>
									</select>
									<?php echo $id_turno ?>
								</div>
								<div class="form-group col-md-2">
									<label for="exampleFormControlSelect1">Contrato</label>
									<input type="text" class="form-control" id="contrato" name="contrato" placeholder="C42554545478" value="<?php echo @$contrato_col ?>">
								</div>
								<div class="form-group col-md-2">
									<label for="exampleFormControlSelect1">Matricla Veiculo</label>
									<input type="text" class="form-control" id="matricula_veiculo" name="matricula_veiculo" placeholder="LD-000-000" value="<?php echo @$matricula_veiculo_col ?>">
								</div>
								<div class="form-group col-md-4">
									<div class="custom-file">
										<input type="hidden" name="foto" id="foto">
									</div>

								</div>
							</div>
							
							<div class="form-row mt-4">
								<div class="form-group col-md-12">
									<label for="exampleFormControlSelect1">Mais Informações</label>
									<textarea class="form-control" rows="5" id="obs" name="obs" placeholder="Mais Info"><?php echo @$obs_col ?></textarea>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">	
					<button  id="<?php echo $nome_botão ?>" name="<?php echo $nome_botão ?>" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;<?php echo $nome_botão ?></button>&nbsp; ou &nbsp;
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
if (@$_GET['funcao'] == 'consulta') {
	$id_reg = $_GET['id'];

	//Pesquisa dados a ser registados na DB
	$res = $pdo->query("SELECT * from colaboradores where id = '$id_reg' ");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	$id = $dados[0]['id'];	
	$nome_col = $dados[0]['nome'];
	$data_nascimento_col = $dados[0]['data_nascimento'];
	$idade_col = $dados[0]['idade'];
	$estado_civil = $dados[0]['estado_civil'];
	$nacionalidade = $dados[0]['nacionalidade'];
	$morada_col = $dados[0]['morada'];
	$email_col = $dados[0]['email'];
	$telefone_col = $dados[0]['telefone'];
	$bilhete_col = $dados[0]['bilhete'];
	$nif_col = $dados[0]['nif'];
	$nss_col = $dados[0]['nss'];
	$carta_conducao_col = $dados[0]['carta_conducao'];
	$telefone_emergencia_col = $dados[0]['telefone_emergencia'];
	$nome_emergencia_col = $dados[0]['nome_emergencia'];
	$parentesco_emergencia = $dados[0]['parentesco_emergencia'];
	$grau_ensino = $dados[0]['grau_ensino'];
	$curso_col = $dados[0]['curso'];
	$instituicao_formacao = $dados[0]['instituicao_formacao'];
	$nome_banco_col = $dados[0]['nome_banco'];
	$iban_col = $dados[0]['iban'];
	$bic_swift_col = $dados[0]['bic_swift'];
	$codigo_colaborador = $dados[0]['codigo_colaborador'];
	$telefone2_col = $dados[0]['telefone2'];
	$email_pro_col = $dados[0]['email_pro'];
	$cargo = $dados[0]['cargo'];
	$salario_bruto_col = $dados[0]['salario_bruto'];
	$turno = $dados[0]['turno'];
	$obs_col = $dados[0]['obs'];
	$contrato_col = $dados[0]['contrato'];
	$matricula_veiculo_col = $dados[0]['matricula_veiculo'];
	$dificienca_col = $dados[0]['dificienca'];
	$num_dependentes = $dados[0]['num_dependentes'];
	$sexo = $dados[0]['sexo'];
	$idade_col = $dados[0]['idade'];

	?>
	<div class="modal" id="ModalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<nav class="navbar navbar-dark mb-2">
			<div class="header-container fixed-top">
				<header class="header navbar navbar-expand-sm">

					<ul class="navbar-item theme-brand flex-row  text-center">
						<li class="nav-item theme-logo">
							<img src="../assets/img/logi1.png" class="navbar-logo" alt="logo" style="width: 35px; height: 20px;">
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
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>&nbsp;&nbsp;<b>CONSULTA DE DADOS</b></a>
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
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#dados1" role="tab" aria-controls="home" aria-selected="true">DADOS 1</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#dados2" role="tab" aria-controls="profile" aria-selected="false">DADOS 2</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="contact-tab" data-toggle="tab" href="#dados3" role="tab" aria-controls="contact" aria-selected="false">DADOS 3</a>
							</li>
							<li class="nav-item ml-auto mt-2">
								<h6>COLABORADOR Nº <b><?php echo @$codigo_colaborador ?></b></h6>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="dados1" role="tabpanel" aria-labelledby="home-tab">
								<br><b>Dados Pessoais</b><hr>
								<div class="form-row">
									<input type="hidden" id="id" name="id" value="<?php echo @$id_reg ?>">
									<input type="hidden" id="nif_antigo" name="nif_antigo" value="<?php echo @$nif_col ?>">
									<input type="hidden" id="codigo_colaborador" name="codigo_colaborador" value="<?php echo @$codigo_colaborador ?>">
									<input type="hidden" class="form-control" id="idade" name="idade" placeholder="Idade" value="<?php echo @$idade ?>" disabled>
									<div class="form-group col-md-6">
										<label for="exampleFormControlSelect1">Nome Completo</label>
										<input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João Paulo" value="<?php echo @$nome_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Data de Nascimento</label>
										<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Data Nascimento" value="<?php echo @$data_nascimento_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Idade</label>
										<input type="text" class="form-control" id="idade" name="idade" placeholder="Idade" value="<?php echo @$idade_col ?>">
									</div>
								</div>

								<div class="form-row mt-4">
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Estado Cívil</label>
										<select class="form-control" id="estado_civil" name="estado_civil">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$estado_civil.'">'.$estado_civil.'</option>';
											}
											?>
											<?php if($estado_civil != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($estado_civil != 'Solteiro(a)') echo '<option value="Solteiro(a)">Solteiro(a)</option>'; ?>

											<?php if($estado_civil != 'Casado(a)') echo '<option value="Casado(a)">Casado(a)</option>'; ?>

											<?php if($estado_civil != 'Viuvo(a)') echo '<option value="Viuvo(a)">Viuvo(a)</option>'; ?>

											<?php if($estado_civil != 'Divorciado') echo '<option value="Divorciado(a)">Divorciado(a)</option>'; ?>

											<?php if($estado_civil != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Endereço Completo</label>
										<input type="text" class="form-control" id="morada" name="morada" placeholder="Ex: Rua da Vila Alice" value="<?php echo @$morada_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">E-mail Pessoal</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="email@email.com" value="<?php echo @$email_col ?>">
									</div>

									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Telemóvel Pessoal</label>
										<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Contribuinte" value="<?php echo @$telefone_col ?>">
									</div>
								</div>
								<div class="form-row mt-4">
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Nacionalidade</label>
										<select class="form-control" id="nacionalidade" name="nacionalidade">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$nacionalidade.'">'.$nacionalidade.'</option>';
											}
											?>
											<?php if($nacionalidade != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($nacionalidade != 'Angolano') echo '<option value="Angolano">Angolano</option>'; ?>

											<?php if($nacionalidade != 'Chinês') echo '<option value="Chinês">Chinês</option>'; ?>

											<?php if($nacionalidade != 'Brasileiro') echo '<option value="Brasileiro">Brasileiro</option>'; ?>

											<?php if($nacionalidade != 'Sul Africano') echo '<option value="Sul Africano">Sul Africano</option>'; ?>

											<?php if($nacionalidade != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
										</select>

									</div>
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Sexo</label>
										<select class="form-control" id="sexo" name="sexo">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$sexo.'">'.$sexo.'</option>';
											}
											?>
											<?php if($sexo != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($sexo != 'Masculino') echo '<option value="Masculino">Masculino</option>'; ?>

											<?php if($sexo != 'Feminino') echo '<option value="Feminino">Feminino</option>'; ?>

											<?php if($sexo != 'Outro') echo '<option value="Outro">Outro</option>'; ?>
										</select>

									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Nº de Bilhete</label>
										<input type="text" class="form-control" id="bilhete" name="bilhete" placeholder="123456789" value="<?php echo @$bilhete_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Nº de Contribuinte</label>
										<input type="text" class="form-control" id="nif" name="nif" placeholder="123456789" value="<?php echo @$nif_col ?>">
									</div>
								</div>
								<div class="form-row mt-4">
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Nº de Segurança Social</label>
										<input type="text" class="form-control" id="nss" name="nss" placeholder="123456789" value="<?php echo @$nss_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Nº de Carta de Condução</label>
										<input type="text" class="form-control" id="carta_conducao" name="carta_conducao" placeholder="123456789" value="<?php echo @$carta_conducao_col ?>">
									</div>
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Nº de Dependentes</label>
										<select class="form-control" id="num_dependentes" name="num_dependentes">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$num_dependentes.'">'.$num_dependentes.'</option>';
											}
											?>
											<?php if($num_dependentes != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($num_dependentes != '0') echo '<option value="0">0</option>'; ?>
											<?php if($num_dependentes != '1') echo '<option value="1">1</option>'; ?>
											<?php if($num_dependentes != '2') echo '<option value="2">2</option>'; ?>
											<?php if($num_dependentes != '3') echo '<option value="3">3</option>'; ?>
											<?php if($num_dependentes != '4') echo '<option value="4">4</option>'; ?>
											<?php if($num_dependentes != '5') echo '<option value="5">5</option>'; ?>
											<?php if($num_dependentes != '6') echo '<option value="6">6</option>'; ?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Dificiênça</label>
										<input type="text" class="form-control" id="dificienca" name="dificienca" placeholder="Dificiênca" value="<?php echo @$dificienca_col ?>">
									</div>
								</div>


							</div>
							<div class="tab-pane fade" id="dados2" role="tabpanel" aria-labelledby="profile-tab">
								<br><b>Contacto de Emergência</b> <hr>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="exampleFormControlSelect1">Nome Completo</label>
										<input type="text" class="form-control" id="nome_emergencia" name="nome_emergencia" placeholder="Ex: João Paulo" value="<?php echo @$nome_emergencia_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Telemóvel </label>
										<input type="text" class="form-control" id="telefone_emergencia" name="telefone_emergencia" placeholder="900000000" value="<?php echo @$telefone_emergencia_col ?>">
									</div>
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Parentesco</label>
										<select class="form-control" id="parentesco_emergencia" name="parentesco_emergencia">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$parentesco_emergencia.'">'.$parentesco_emergencia.'</option>';
											}
											?>
											<?php if($parentesco_emergencia != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($parentesco_emergencia != 'Marido') echo '<option value="Marido">Marido</option>'; ?>

											<?php if($parentesco_emergencia != 'Mulher') echo '<option value="Mulher">Mulher</option>'; ?>

											<?php if($parentesco_emergencia != 'Pai') echo '<option value="Pai">Pai</option>'; ?>

											<?php if($parentesco_emergencia != 'Mãe') echo '<option value="Mãe">Mãe</option>'; ?>

											<?php if($parentesco_emergencia != 'Filho') echo '<option value="Filho">Filho</option>'; ?>
										</select>
									</div>
								</div>

								<br><b>Dados Acadêmicos</b>
								<div class="form-row mt-4">
									<div class="form-group col-md-6">
										<label for="exampleFormControlSelect1">Nome da Instituição</label>
										<input type="text" class="form-control" id="instituicao_formacao" name="instituicao_formacao" placeholder="Ex: Instituto Médio Técnico " value="<?php echo @$instituicao_formacao ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Curso</label>
										<input type="text" class="form-control" id="curso" name="curso" placeholder="Ex: Mecanica" value="<?php echo @$curso_col ?>">
									</div>
									<div class="form-group col-md-3 col-sm-12">
										<label for="exampleFormControlSelect1">Grau de Ensino</label>
										<select class="form-control" id="grau_ensino" name="grau_ensino">

											<?php 
											if(@$_GET['funcao'] == 'consulta'){
												echo '<option value="'.$grau_ensino.'">'.$grau_ensino.'</option>';
											}
											?>
											<?php if($grau_ensino != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
											<?php if($grau_ensino != 'Básico') echo '<option value="Básico">Básico</option>'; ?>

											<?php if($grau_ensino != 'Médio') echo '<option value="Médio">Médio</option>'; ?>

											<?php if($grau_ensino != '1º Ciclo Ensino Superior') echo '<option value="1º Ciclo Ensino Superior">1º Ciclo Ensino Superior</option>'; ?>

											<?php if($grau_ensino != '2º Ciclo Ensino Superior') echo '<option value="2º Ciclo Ensino Superior">2º Ciclo Ensino Superior</option>'; ?>

											<?php if($grau_ensino != '3º Ciclo Ensino Superior') echo '<option value="3º Ciclo Ensino Superior">3º Ciclo Ensino Superior</option>'; ?>
										</select>
									</div>
								</div>

								<br><b>Dados Bancarios</b>
								<div class="form-row mt-4">
									<div class="form-group col-md-6">
										<label for="exampleFormControlSelect1">Nome do Banco</label>
										<input type="text" class="form-control" id="nome_banco" name="nome_banco" placeholder="Ex: Banco da Vila Alice" value="<?php echo @$nome_banco_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">IBAN</label>
										<input type="text" class="form-control" id="iban" name="iban" placeholder="AOA000000000000" value="<?php echo @$iban_col ?>">
									</div>
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">BIC SWIFT</label>
										<input type="bic_swift" class="form-control" id="bic_swift" name="bic_swift" placeholder="BTWBNMA" value="<?php echo @$bic_swift_col ?>">
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="dados3" role="tabpanel" aria-labelledby="contact-tab">
								<br><b>Dados Profissionais</b> <hr>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label for="exampleFormControlSelect1">Cargo</label>
										<select class="form-control" id="cargo" name="cargo">

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
									<div class="form-group col-md-4">
										<label for="exampleFormControlSelect1">Telefone Profissional</label>
										<input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="9000000000" value="<?php echo @$telefone2_col ?>">
									</div>
									<div class="form-group col-md-4">
										<label for="exampleFormControlSelect1">E-mail Profissional</label>
										<input type="email" class="form-control" id="email_pro" name="email_pro" placeholder="mail@tuaempresa.com" value="<?php echo @$email_pro_col ?>">
									</div>
								</div>
								
								<div class="form-row mt-4">
									<div class="form-group col-md-3">
										<label for="exampleFormControlSelect1">Salário Bruto</label>
										<input type="text" class="form-control" id="salario_bruto" name="salario_bruto" placeholder="0.000.000" value="<?php echo @$salario_bruto_col ?>">
									</div>
									<div class="form-group col-md-2">
										<label for="exampleFormControlSelect1">Turno</label>
										<select class="form-control select2 selec" id="turno" name="turno">

											<?php 
								//SE EXISTIR EDIÇÃO DOS DADOS, TRAZER COMO PRIMEIRO REGISTRO A ESPECIALIZAÇÃO DO MÉDICO
											if(@$_GET['funcao'] == 'consulta'){

												$res_espec = $pdo->query("SELECT * from turnos where id = '$id'");
												$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

												for ($i=0; $i < count($dados_espec); $i++) { 
													foreach ($dados_espec[$i] as $key => $value) {
													}

													$id_cargo = $dados_espec[$i]['id'];	
													$entrada = $dados_espec[$i]['entrada'];
													$saida = $dados_espec[$i]['saida'];

												}


												echo '<option value="'.$id_cargo.'">'.$entrada.' - '.$saida.'</option>';
											}



								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
											$res = $pdo->query("SELECT * from turnos order by id asc");
											$dados = $res->fetchAll(PDO::FETCH_ASSOC);

											for ($i=0; $i < count($dados); $i++) { 
												foreach ($dados[$i] as $key => $value) {
												}

												$id = $dados[$i]['id'];	
												$entrada = $dados[$i]['entrada'];
												$saida = $dados[$i]['saida'];

												if($entrada1 != $entrada){
													echo '<option value="'.$id.'">'.$entrada.' - '.$saida.'</option>';
												}


											}
											?>

										</select>
									</div>
									<div class="form-group col-md-2">
										<label for="exampleFormControlSelect1">Contrato</label>
										<input type="text" class="form-control" id="contrato" name="contrato" placeholder="C42554545478" value="<?php echo @$contrato_col ?>">
									</div>
									<div class="form-group col-md-2">
										<label for="exampleFormControlSelect1">Matricla Veiculo</label>
										<input type="text" class="form-control" id="matricula_veiculo" name="matricula_veiculo" placeholder="LD-000-000" value="<?php echo @$matricula_veiculo_col ?>">
									</div>
									<div class="form-group col-md-2">
										<label for="inputAddress">Fotografia</label>
										<div class="custom-file">
											<input type="file" name="foto" id="foto">
										</div>

									</div>
								</div>
								
								<div class="form-row mt-4">
									<div class="form-group col-md-12">
										<label for="exampleFormControlSelect1">Mais Informações</label>
										<textarea class="form-control" id="obs" name="obs" rows="5" placeholder="Mais Info"><?php echo @$obs_col ?></textarea>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="modal-footer">	
						<button id="btn-fechar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
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
	//Pesquisa dados a ser registados na DB
	$res = $pdo->query("SELECT * from colaboradores where id = '$id' ");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$nome_col = $dados[0]['nome'];

	?>

	<div class="modal" id="ModalConsulta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<nav class="navbar navbar-dark mb-2">
			<div class="header-container fixed-top">
				<header class="header navbar navbar-expand-sm">

					<ul class="navbar-item theme-brand flex-row  text-center">
						<li class="nav-item theme-logo">
							<img src="../assets/img/logi1.png" class="navbar-logo" alt="logo" style="width: 35px; height: 20px;">
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
					<input type="hidden" id="nome" name="nome" value="<?php echo @$nome ?>">
					<p>Selecione abaixo <b>Excluir</b> se estiver pronto para eliminar o registro do(a) Colaborador(a): <?php echo $nome_col ?></p>
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
						$('#nif').val('')
						$('#num_bi').val('')
						$('#data_nasc').val('')
						$('#idade').val('')
						$('#salario').val('')
						$('#endereco').val('')
						$('#email').val('')
						$('#telefone').val('')
						$('#info').val('')

						$('#txtpesquisar').val('')
						$('#btnpesquisar').click();
						//$('#btn-fechar').click();

					}else{
						$('#mensagem').addClass('mensagem-erro')
					}
					
					$('#mensagem').text(mensagem)
				}
				
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
	$('#txtpesquisar').change(function(){
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

<!--<script src="../js/mascaras.js"></script>-->