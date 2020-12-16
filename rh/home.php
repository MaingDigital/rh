 
<?php 


$res_1 = $pdo->query("SELECT * from ausencias where estado = 'Aprovado' ");
$dados_1 = $res_1->fetchAll(PDO::FETCH_ASSOC);
$valor_1 = count($dados_1);


//TOTALIZAR AS MOVIMENTAÇÕES
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicial = $ano_atual.'-'.$mes_atual.'-01';


$res = $pdo->query("SELECT * from movimentacoes where data >= '$data_inicial' and data <= curDate()");

$dados = $res->fetchAll(PDO::FETCH_ASSOC);

$total_entradas = 0;
$total_saidas = 0;

for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$tipo = $dados[$i]['tipo'];
	$valor = $dados[$i]['valor'];
	

	if($tipo == 'Entrada'){
		@$total_entradas = $total_entradas + $valor;
	}else{
		@$total_saidas = $total_saidas + $valor;
	}

}

@$total = @$total_entradas - @$total_saidas;
if(@$total >= 0){
	$classe_valor = 'text-success';
}else{
	$classe_valor = 'text-danger';
}




$res_3 = $pdo->query("SELECT * from consultas where status = 'Finalizada' and (data >= '$data_inicial' and data <= curDate() ) ");
$dados_3 = $res_3->fetchAll(PDO::FETCH_ASSOC);
$valor_3 = count($dados_3);


$res_4 = $pdo->query("SELECT * from colaboradores ");
$dados_4 = $res_4->fetchAll(PDO::FETCH_ASSOC);
$valor_4 = count($dados_4);

$res_5 = $pdo->query("SELECT * from usuarios ");
$dados_5 = $res_5->fetchAll(PDO::FETCH_ASSOC);
$valor_5 = count($dados_5);

$res_7 = $pdo->query("SELECT * from cargos ");
$dados_7 = $res_7->fetchAll(PDO::FETCH_ASSOC);
$valor_7 = count($dados_7);

$res_6 = $pdo->query("SELECT * from consultas where pgto_confirmado != 'Sim' ");
$dados_6 = $res_6->fetchAll(PDO::FETCH_ASSOC);
$valor_6 = count($dados_6);

?>

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	<div class="widget-content widget-content-area br-6">
	<!--	<div class="area_cards">
			<div class="row">

				<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
					<div class="card card-stats">
						<div class="card-body ">
							<div class="row">
								<div class="col-5 col-md-4">
									<div class="icone-card text-center text-secondary icon-warning">
										<i class="fas fa-users"></i>
									</div>
								</div>
								<div class="col-7 col-md-8">
									<div class="numbers">
										<p class="titulo-card">Total de Funcionários</p>
										<p class="subtitulo-card"><?php echo $valor_4 ?><p>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer rodape-card">
								Total de Funcionários Efectivos

							</div>
						</div>
					</div>


					<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
						<div class="card card-stats">
							<div class="card-body ">
								<div class="row">
									<div class="col-5 col-md-4">
										<div class="icone-card text-center text-info">
											<i class="fas fa-user-md"></i>
										</div>
									</div>
									<div class="col-7 col-md-8">
										<div class="numbers">
											<p class="titulo-card">Total de Médicos</p>
											<p class="subtitulo-card"><?php echo $valor_1 ?><p>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer rodape-card">
									Total de Médicos Em Serviço

								</div>
							</div>
						</div>


						<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
							<div class="card card-stats">
								<div class="card-body ">
									<div class="row">
										<div class="col-5 col-md-4">
											<div class="icone-card text-center <?php echo $classe_valor ?>">
												<i class="fas fa-dollar-sign"></i>
											</div>
										</div>
										<div class="col-7 col-md-8">
											<div class="numbers">
												<p class="titulo-card">Total de Receita</p>
												<p class="subtitulo-card <?php echo $classe_valor ?>"><?php echo ($total) ?> KZ<p>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer rodape-card">
										Valor Total do Mês

									</div>
								</div>
							</div>


							<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5 col-md-4">
												<div class="icone-card text-center text-info">
													<i class="fas fa-notes-medical"></i>
												</div>
											</div>
											<div class="col-7 col-md-8">
												<div class="numbers">
													<p class="titulo-card">Total de Consultas</p>
													<p class="subtitulo-card"><?php echo $valor_3 ?><p>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer rodape-card">
											Total de Consultas no Mês

										</div>
									</div>
								</div>





								<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
									<div class="card card-stats">
										<div class="card-body ">
											<div class="row">
												<div class="col-5 col-md-4">
													<div class="icone-card text-center text-danger">
														<i class="fas fa-money-check-alt"></i>
													</div>
												</div>
												<div class="col-7 col-md-8">
													<div class="numbers">
														<p class="titulo-card">Total de Gastos</p>
														<p class="subtitulo-card"><span class="text-danger"><?php echo round($total_saidas) ?> KZ</span><p>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer rodape-card">
												Total de Gastos no Mês

											</div>
										</div>
									</div>




									<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
										<div class="card card-stats">
											<div class="card-body ">
												<div class="row">
													<div class="col-5 col-md-4">
														<div class="icone-card text-center text-warning">
															<i class="fas fa-stethoscope"></i>
														</div>
													</div>
													<div class="col-7 col-md-8">
														<div class="numbers">
															<p class="titulo-card">Consultas Agendadas</p>
															<p class="subtitulo-card"><?php echo $valor_6 ?><p>
															</div>
														</div>
													</div>
												</div>
												<div class="card-footer rodape-card">
													Total de Consultas Agendadas

												</div>
											</div>
										</div>


									</div>
								</div> -->



								<div class="row ml-1 mr-1">
									<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
										<div class="widget-small warning coloured-icon"><i class="icon fas fa-layer-group fa-3x"></i>
											<div class="info">
												<h4>CARGOS</h4>
												<p><b><?php echo $valor_7 ?></b></p>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
										<div class="widget-small primary coloured-icon"><i class="icon fas fa-users fa-3x"></i>
											<div class="info">
												<h4>COLABORADORES</h4>
												<p><b><?php echo $valor_4 ?></b></p>
											</div>
										</div>
									</div>
									
									<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
										<div class="widget-small info coloured-icon"><i class="icon fas fa-user fa-3x"></i>
											<div class="info">
												<h4>USUÁRIOS</h4>
												<p><b><?php echo $valor_5 ?></b></p>
											</div>
										</div>
									</div>
									
								
								<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
										<div class="widget-small danger coloured-icon"><i class="icon fas fa-clock fa-3x"></i>
											<div class="info">
												<h4>AUSÊNCIAS</h4>
												<p><b><?php echo $valor_1 ?></b></p>
											</div>
										</div>
									</div>
								</div>

								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
									<div class="widget widget-chart-one">
										<div class="widget-heading">
											<h5 class="">Processamento Salárial</h5>
											<ul class="tabs tab-pills">
												<li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Mensal</a></li>
											</ul>
										</div>

										<div class="widget-content">
											<div class="tabs tab-content">
												<div id="content_1" class="tabcontent"> 
													<div id="revenueMonthly"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<style type="text/css">
							.widget-small {
								display: -webkit-box;
								display: -ms-flexbox;
								display: flex;
								border-radius: 4px;
								color: #FFF;
								margin-bottom: 30px;
								-webkit-box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
								box-shadow: 1px 1px 1px 1px rgba(0.1, 0.1, 0.1, 0.1);
							}

							.widget-small .icon {
								display: -webkit-box;
								display: -ms-flexbox;
								display: flex;
								min-width: 85px;
								-webkit-box-align: center;
								-ms-flex-align: center;
								align-items: center;
								-webkit-box-pack: center;
								-ms-flex-pack: center;
								justify-content: center;
								padding: 20px;
								background-color: rgba(0, 0, 0, 0.2);
								border-radius: 4px 0 0 4px;
								font-size: 2.5rem;
							}

							.widget-small .info {
								-webkit-box-flex: 1;
								-ms-flex: 1;
								flex: 1;
								padding: 0 20px;
								-ms-flex-item-align: center;
								align-self: center;
							}

							.widget-small .info h4 {
								text-transform: uppercase;
								margin: 0;
								margin-bottom: 5px;
								font-weight: 400;
								font-size: 1.1rem;
							}

							.widget-small .info p {
								margin: 0;
								font-size: 16px;
							}

							.widget-small.primary {
								background-color: #009688;
							}

							.widget-small.primary.coloured-icon {
								background-color: #fff;
								color: #2a2a2a;
							}

							.widget-small.primary.coloured-icon .icon {
								background-color: #009688;
								color: #fff;
							}

							.widget-small.info {
								background-color: #17a2b8;
							}

							.widget-small.info.coloured-icon {
								background-color: #fff;
								color: #2a2a2a;
							}

							.widget-small.info.coloured-icon .icon {
								background-color: #17a2b8;
								color: #fff;
							}

							.widget-small.warning {
								background-color: #ffc107;
							}

							.widget-small.warning.coloured-icon {
								background-color: #fff;
								color: #2a2a2a;
							}

							.widget-small.warning.coloured-icon .icon {
								background-color: #ffc107;
								color: #fff;
							}

							.widget-small.danger {
								background-color: #dc3545;
							}

							.widget-small.danger.coloured-icon {
								background-color: #fff;
								color: #2a2a2a;
							}

							.widget-small.danger.coloured-icon .icon {
								background-color: #dc3545;
								color: #fff;
							}

						</style>

