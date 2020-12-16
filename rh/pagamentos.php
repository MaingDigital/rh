<?php $pagina = 'pagamentos';
$agora = date('Y-m-d'); ?>


<style type="text/css">
	.carregando{
		color:#ff0000;
		display:none;
	}
</style>

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">
		<div class="row btnnovo mt-1">
			<div class="col-md-2 col-sm-12">
				<div class="float-left">
					<a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
					<a href="index.php?acao=<?php echo $pagina ?>&funcao=novo"  type="button" class="btn btn-secondary btn-lg">Processar</a>
				</div>
			</div>

			<div class="col-md-1 col-sm-12">
				<div class="float-left">

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
						<label>Pesquisar&emsp;</label>
						<input class="form-control form-control-sm mr-sm-2" type="text" name="txtpesquisar" id="txtpesquisar" placeholder="Nome ou nif">

						<input class="form-control form-control-sm mr-sm-2" type="date" name="dataInicial" id="dataInicial" value="<?php echo $agora ?>">

						<input class="form-control form-control-sm" type="date" name="dataFinal" id="dataFinal" value="<?php echo $agora ?>">
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
						<a class="testo mt-2"><i class="fas fa-folder-plus"></i><b>
							Processamento de Salários
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
				<form id="form" method="post" enctype="multipart/form-data">
					<div class="form-row">
						
						<div class="form-group col-md-6">
							<label for="exampleFormControlSelect1">Selecionar o Cargo</label>
							<select class="form-control" id="cargos" name="cargos">
								<option value="">Escolha o Cargo</option>


								<?php 

								//TRAZER TODOS OS REGISTROS DE ESPECIALIZAÇÕES
								$res = $pdo->query("SELECT * from cargos order by cargo asc");
								$dados = $res->fetchAll(PDO::FETCH_ASSOC);

								for ($i=0; $i < count($dados); $i++) { 
									foreach ($dados[$i] as $key => $value) {
									}

									$id = $dados[$i]['id'];	
									$cargo = $dados[$i]['cargo'];


									echo '<option value="'.$cargo.'">'.$cargo.'</option>';
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="exampleFormControlSelect1">Funcionário</label>
							<span class="carregando">Aguarde, carregando...</span>
							<select class="form-control" id="funcionario" name="funcionario">
								<option value="">Escolha o Funcionário</option>

							</select>
						</div>

						<div class="form-group col-md-3 mt-3">
							<label for="exampleFormControlSelect1">Salário Base</label>
							<input type="text" class="form-control" id="valor" name="valor" placeholder="1000" required>
						</div>
						<input type="hidden" id="salario" name="salario" value="<?php echo @$salario ?>">

						<input type="hidden" id="excesso" name="excesso" value="<?php echo @$excesso ?>">

						<input type="hidden" id="irt" name="irt" value="<?php echo @$irt ?>">

						<input type="hidden" id="tx_fixa" name="tx_fixa" value="<?php echo @$tx_fixa ?>">

						<input type="hidden" id="escalao" name="escalao" value="<?php echo @$escalao ?>">

						<input type="hidden" id="excesso_dee" name="excesso_dee" value="<?php echo @$excesso_dee ?>">

						<input type="hidden" id="percent" name="percent" value="<?php echo @$percent ?>">

						<input type="hidden" id="estado" name="estado" value="<?php echo @$estado ?>">

						<input type="hidden" id="enc_empresa" name="enc_empresa" value="<?php echo @$enc_empresa ?>">
					<!--	<div class="form-group col-md-12">
							<label for="inputAddress">Carregar o comprovativo</label>
							<div class="custom-file">
								<input type="file" name="foto" id="foto">
							</div>
							percent
						</div> -->
						<div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Desconto INSS</label>
			            <select class="form-control" id="inss" name="inss">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$inss.'">'.$inss.'</option>';
			              }
			              ?>
			              
			              <?php if($inss != '0.03') echo '<option value="0.03">3%</option>'; ?>

			            </select>
			          </div>
				<!--		<div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Desconto IRT</label>
			            <select class="form-control" id="irt" name="irt">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$irt.'">'.$irt.'</option>';
			              }
			              ?>
			              <?php if($irt != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($irt != '0') echo '<option value="0">1º Escalão</option>'; ?>
			              <?php if($irt != '0.10') echo '<option value="0.10">2º Escalão 10%</option>'; ?>
			              <?php if($irt != '0.13') echo '<option value="0.13">3º Escalão 13%</option>'; ?>
			              <?php if($irt != '0.16') echo '<option value="0.16">4º Escalão 16%</option>'; ?>
			              <?php if($irt != '0.18') echo '<option value="0.18">5º Escalão 18%</option>'; ?>
			              <?php if($irt != '0.19') echo '<option value="0.19">6º Escalão 19%</option>'; ?>
			              <?php if($irt != '0.20') echo '<option value="0.20">7º Escalão 20%</option>'; ?>
			              <?php if($irt != '0.21') echo '<option value="0.21">8º Escalão 21%</option>'; ?>
			              <?php if($irt != '0.22') echo '<option value="0.22">9º Escalão 22%</option>'; ?>
			              <?php if($irt != '0.23') echo '<option value="0.23">10º Escalão 23%</option>'; ?>
			              <?php if($irt != '0.24') echo '<option value="0.24">11º Escalão 24%</option>'; ?>
			              <?php if($irt != '0.25') echo '<option value="0.25">12º Escalão 24,5%</option>'; ?>
			              <?php if($irt != '0.25') echo '<option value="0.25">13º Escalão 25%</option>'; ?>
			              
			              
			            </select>
			          </div>
			          <div class="form-group col-md-3 mt-3">
							<label for="exampleFormControlSelect1">Taxa Fixa</label>
							<input type="text" class="form-control" id="tx_fixa" name="tx_fixa" placeholder="Ex: 50000" required>
						</div> -->
					  <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio de Férias</label>
			            <select class="form-control" id="s_ferias" name="s_ferias">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_ferias.'">'.$s_ferias.'</option>';
			              }
			              ?>
			              <?php if($s_ferias != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_ferias != '0.50') echo '<option value="0.50">50%</option>'; ?>
			              <?php if($s_ferias != '100') echo '<option value="100">100%</option>'; ?>

			            </select>
			          </div>    
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio de Natal</label>
			            <select class="form-control" id="s_natal" name="s_natal">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_natal.'">'.$s_natal.'</option>';
			              }
			              ?>
			              <?php if($s_natal != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_natal != '0.50') echo '<option value="50%">50%</option>'; ?>
			              <?php if($s_natal != '100') echo '<option value="100%">100%</option>'; ?>

			            </select>
			          </div>
			          
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Abono Familiar</label>
			            <select class="form-control" id="abono_f" name="abono_f">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$abono_f.'">'.$abono_f.'</option>';
			              }
			              ?>
			              <?php if($abono_f != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($abono_f != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($abono_f != '0.10') echo '<option value="0.10">10%</option>'; ?>
			              <?php if($abono_f != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($abono_f != '0.20') echo '<option value="0.20">20%</option>'; ?>

			            </select>
			          </div>
			          
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio de Alimentação</label>
			            <select class="form-control" id="s_alimento" name="s_alimento">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_alimento.'">'.$s_alimento.'</option>';
			              }
			              ?>
			              <?php if($s_alimento != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_alimento != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($s_alimento != '0.10') echo '<option value="0.10">10%</option>'; ?>
			              <?php if($s_alimento != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($s_alimento != '0.20') echo '<option value="0.20">20%</option>'; ?>

			            </select>
			          </div>
			          
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio Transporte</label>
			            <select class="form-control" id="s_trans" name="s_trans">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_trans.'">'.$s_trans.'</option>';
			              }
			              ?>
			              <?php if($s_trans != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_trans != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($s_trans != '0.10') echo '<option value="0.10">10%</option>'; ?>
			              <?php if($s_trans != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($s_trans != '0.20') echo '<option value="0.20">20%</option>'; ?>

			            </select>
			          </div>
			          
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Abono de Falha</label>
			            <select class="form-control" id="a_falha" name="a_falha">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$a_falha.'">'.$a_falha.'</option>';
			              }
			              ?>
			              <?php if($a_falha != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($a_falha != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($a_falha != '0.10') echo '<option value="0.10">10%</option>'; ?>
			              <?php if($a_falha != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($a_falha != '0.20') echo '<option value="0.20">20%</option>'; ?>
			            </select>
			          </div>
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio de Renda</label>
			            <select class="form-control" id="s_renda" name="s_renda">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_renda.'">'.$s_renda.'</option>';
			              }
			              ?>
			              <?php if($s_renda != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_renda != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($s_renda != '0.1') echo '<option value="0.1">10%</option>'; ?>
			              <?php if($s_renda != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($s_renda != '0.2') echo '<option value="0.2">20%</option>'; ?>
			              <?php if($s_renda != '0.3') echo '<option value="0.3">30%</option>'; ?>
			              <?php if($s_renda != '0.4') echo '<option value="0.4">40%</option>'; ?>
			              <?php if($s_renda != '0.5') echo '<option value="0.5">50%</option>'; ?>
			              <?php if($s_renda != '0.6') echo '<option value="0.6">60%</option>'; ?>
			              <?php if($s_renda != '0.7') echo '<option value="0.7">70%</option>'; ?>

			            </select>
			          </div>

			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio de Deslocação</label>
			            <input type="text" class="form-control" id="s_desl" name="s_desl" placeholder="Ex: 50000" required>
			          </div>

			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Tipo de Desconto</label>
			            <select class="form-control" id="tipo_desc" name="tipo_desc">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$tipo_desc.'">'.$tipo_desc.'</option>';
			              }
			              ?>
			              <?php if($tipo_desc != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
			              <?php if($tipo_desc != 'Falta') echo '<option value="Falta">Falta</option>'; ?>

			              <?php if($tipo_desc != 'Falta Não Justificada') echo '<option value="Falta Não Justificada">Falta Não Justificada</option>'; ?>

			              <?php if($tipo_desc != 'Falta Justificada') echo '<option value="Falta Justificada">Falta Justificada</option>'; ?>

			              <?php if($tipo_desc != 'Outros') echo '<option value="Outros">Outros</option>'; ?>
			            </select>
			          </div>
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Valor do Desconto</label>
			            <input type="text" class="form-control" id="desconto" name="desconto" placeholder="Ex: 50000" required>
			          </div>
			          
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Prémio Mensal</label>
			            <select class="form-control" id="tipo_premio" name="tipo_premio">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$tipo_premio.'">'.$tipo_premio.'</option>';
			              }
			              ?>
			              <?php if($tipo_premio != 'Selecionar') echo '<option value="Selecionar">Selecionar</option>'; ?>
			              <?php if($tipo_premio != 'Colaborador do Mês') echo '<option value="Colaborador do Mês">Colaborador do Mês</option>'; ?>

			              <?php if($tipo_premio != 'Asiduidade') echo '<option value="Asiduidade">Asiduidade</option>'; ?>

			              <?php if($tipo_premio != 'Médico do Més') echo '<option value="Médico do Més">Médico do Més</option>'; ?>

			              <?php if($tipo_premio != 'Outros') echo '<option value="Outros">Outros</option>'; ?>
			            </select>
			          </div>
			          <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Valor do Prémio</label>
			            <input type="text" class="form-control" id="premio" name="premio" placeholder="Ex: 50000" required>
			          </div>
			          
			           <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Horas Extras</label>
			            <input type="text" class="form-control" id="h_extras" name="h_extras" placeholder="Ex: 50000" required>
			          </div>


			      <div class="form-group col-md-3 mt-3">
			            <label for="exampleFormControlSelect1">Subsidio Noturno</label>
			            <select class="form-control" id="s_noite" name="s_noite">

			              <?php 
			              if(@$_GET['funcao'] == 'editar'){
			                echo '<option value="'.$s_noite.'">'.$s_noite.'</option>';
			              }
			              ?>
			              <?php if($s_noite != '0') echo '<option value="0">Selecionar</option>'; ?>
			              <?php if($s_noite != '0.05') echo '<option value="0.05">5%</option>'; ?>
			              <?php if($s_noite != '0.10') echo '<option value="0.10">10%</option>'; ?>
			              <?php if($s_noite != '0.15') echo '<option value="0.15">15%</option>'; ?>
			              <?php if($s_noite != '0.20') echo '<option value="0.20">20%</option>'; ?>

			            </select>
			          </div>
			         </div>
				</div>
				<div class="modal-footer">	
					<button id="salvar" name="salvar" class="btn btn-secondary"><i class="far fa-save"></i>&nbsp;&nbsp;Processar</button>&nbsp; ou &nbsp;
					<button id="btn-fechar" type="button" class="btn btn-dark" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Fechar</button>
				</div>
			</form>
		</div>
	</div>
</div>

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


<!--
CÓDIGO BAIXAR O PAGAMENTO
-->
<?php 
if (@$_GET['funcao'] == 'baixar' && @$item_paginado == '') { 

	$id = $_GET['id'];
	?>

	<div class="modal" id="ModalBaixar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
							<a class="testo mt-2"><i class="fas fa-folder-plus"></i>&nbsp;<b>Confirmar pagamento</b></a>
						</li>
					</ul>
				</header>
			</div>
		</nav>
		<br>
		<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
			<div class="modal-content mt-4">
				<div class="modal-body mt-4">
			<p><h5>Selecione abaixo <b>Confirmar</b> se estiver pronto para registrar o pagamento</h5></p>
			<br><br>
			<?php $res_valor = $pdo->query("SELECT * from pagamentos where id = '$id'");
				$dados_valor  = $res_valor ->fetchAll(PDO::FETCH_ASSOC);
				$salario = $dados_valor [0]['salario'];
				$nome_funcionario = $dados_valor [0]['nome_funcionario'];
				$inss = $dados_valor [0]['inss'];
				$irt = $dados_valor [0]['irt'];
				$s_ferias = $dados_valor [0]['s_ferias'];
				$s_natal = $dados_valor [0]['s_natal'];
				$abono_f = $dados_valor [0]['abono_f'];
				$s_alimento = $dados_valor [0]['s_alimento'];
				$s_trans = $dados_valor [0]['s_trans'];
				$a_falha = $dados_valor [0]['a_falha'];
				$s_renda = $dados_valor [0]['s_renda'];
				$s_desl = $dados_valor [0]['s_desl'];
				$s_noite = $dados_valor [0]['s_noite'];
				$h_extras = $dados_valor [0]['h_extras'];
				$id = $dados_valor [0]['id'];


			?>
			<table class="table">
					<thead>
						<th>Colaborador</th>
						<td><?php echo @$nome_funcionario ?></td>
						<th>Vencimento</th>
						<td><?php echo number_format("$salario",2,",",".") ?> KZ</td>
					</thead>
			</table>
		<!--	<table class="mt-3">
					<thead>
						<th>&nbsp;&nbsp;INSS&emsp;</th>
						<td><?php echo @$inss ?></td>
					</thead>
			</table>
			<table class="mt-3">
					<thead>
						<th>&nbsp;&nbsp;Abono Familia&emsp;</th>
						<td><?php echo number_format("$abono_f",2,",",".") ?> KZ</td>
					</thead>
			</table>
			<table class="mt-3">
					<thead>
						<th>&nbsp;&nbsp;Subsidio Alimentação&emsp;</th>
						<td><?php echo number_format("$s_alimento",2,",",".") ?> KZ</td>
					</thead>
			</table>

			<table class="mt-3">
					<thead>
						<th>&nbsp;&nbsp;Subsidio de Renda&emsp;</th>
						<td><?php echo number_format("$s_renda",2,",",".") ?> KZ</td>
					</thead>
			</table>
			<table class="mt-3">
					<thead>
						<th>&nbsp;&nbsp;Subsidio de Renda&emsp;</th>
						<td><?php echo number_format("$s_renda",2,",",".") ?> KZ</td>
					</thead>
			</table> -->
			
		</div>
		<div class="modal-footer">
			<form method="post">
				<input type="hidden" id="id" name="id" value="<?php echo @$id ?>">

				<button class="btn btn-success" name="btn-baixar" id="btn-baixar" type="button" data-dismiss="modal">Confirmar</button>
			</form>
			<button class="btn btn-dark" id="btn-cancelar-editar" name="btn-cancelar-editar" type="button" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;&nbsp;Cancelar</button>
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

<!--AJAX PARA CHAMAR O CARREGAMENTO DO INPUT SELECT A PARTIR DE OUTRO INPUT -->
<script type="text/javascript">
	$(function(){
		$('#cargos').change(function(){
			if( $(this).val() ) {
				$('#funcionario').hide();
				$('.carregando').show();
				$.getJSON('pagamentos/listar-func.php?search=',{cargo: $(this).val(), ajax: 'true'}, function(j){
					var options = '<option value="">Escolha Funcionário</option>';	
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].nif + '">' + j[i].nome + '</option>';
					}	
					$('#funcionario').html(options).show();
					$('.carregando').hide();
				});
			} else {
				$('#funcionario').html('<option value="">– Escolha Funcionário –</option>');
			}
		});
	});
</script>


<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
	$("#form").submit(function () {
		var pag = "<?=$pagina?>";
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: pag + "/inserir.php",
			type: 'POST',
			data: formData,
			success: function (data) {
				$('#btnpesquisar').click();
				$('#btn-fechar').click();
			},
			cache: false,
			contentType: false,
			processData: false,
        xhr: function() {  // Custom XMLHttpRequest
        	var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
            	myXhr.upload.addEventListener('progress', function () {
            		/* faz alguma coisa durante o progresso do upload */
            	}, false);
            }
            return myXhr;
        }
    });
	});
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

					if(mensagem == 'Editado com Sucesso!!'){

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

<!--AJAX PARA BAIXAR O PAGAMENTO -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-baixar').click(function(event){
			event.preventDefault();

			$.ajax({
				url: pag + "/editar.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					
					$('#btnpesquisar').click();
					$('#btn-cancelar-editar').click();

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

					
					$('#btnpesquisar').click();
					$('#btn-cancelar-excluir').click();

				},

			})
		})
	})
</script>


<!--AJAX PARA BUSCAR OS DADOS PELA COMBOBOX AO ALTERAR -->
<script type="text/javascript">
	$('#txtpesquisar').change(function(){
		$('#btnpesquisar').click();
	})
</script>

<!--AJAX PARA BUSCAR OS DADOS PELA TXT 
<script type="text/javascript">
	$('#txtpesquisar').change(function(){
		$('#btnpesquisar').click();
	})
</script>-->

<!--AJAX PARA BUSCAR OS DADOS PELA TXT -->
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

<!--<script type="text/javascript">
	$('#txtpesquisar').keyup(function(){
		$('#btnpesquisar').click();
	})
</script> -->
<!--
SCRIPT PARA CHAMAR MODAL EDITAR
-->
<script>$("#modalconsulta").modal("show");</script>
<script>$("#ModalConsulta").modal("show");</script>
<script>$("#ModalBaixar").modal("show");</script>
<!--
CÓDIGO BOTÃO NOVO
-->