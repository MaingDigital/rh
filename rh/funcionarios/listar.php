<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/custom_dt_html5.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">

<?php

require_once("../../conex.php");
$pagina = 'funcionarios';

?>
<table id="html5-extension" class="table table-hover non-hover" style="position: relative; z-index: 100;">
	<thead style="position: relative; z-index: 100;">
		<tr>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Morada</th>
			<th>Telefone</th>
			<th>Foto</th>
			<th class="text-right">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$txtpesquisar = @$_POST['txtpesquisar'];

		if($txtpesquisar == ''){
		$res = $pdo->query("SELECT * from colaboradores order by id desc");
	}else{
		$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
		$res = $pdo->query("SELECT * from colaboradores order by id desc");
	}
	
	@$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from colaboradores");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {

			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$data_nascimento = $dados[$i]['data_nascimento'];
			$estado_civil = $dados[$i]['estado_civil'];
			$nacionalidade = $dados[$i]['nacionalidade'];
			$morada = $dados[$i]['morada'];
			$email = $dados[$i]['email'];
			$telefone = $dados[$i]['telefone'];
			$bilhete = $dados[$i]['bilhete'];
			$nif = $dados[$i]['nif'];
			$nss = $dados[$i]['nss'];
			$carta_conducao = $dados[$i]['carta_conducao'];
			$telefone_emergencia = $dados[$i]['telefone_emergencia'];
			$nome_emergencia = $dados[$i]['nome_emergencia'];
			$parentesco_emergencia = $dados[$i]['parentesco_emergencia'];
			$grau_ensino = $dados[$i]['grau_ensino'];
			$curso = $dados[$i]['curso'];
			$instituicao_formacao = $dados[$i]['instituicao_formacao'];
			$nome_banco = $dados[$i]['nome_banco'];
			$iban = $dados[$i]['iban'];
			$bic_swift = $dados[$i]['bic_swift'];
			$codigo_colaborador = $dados[$i]['codigo_colaborador'];
			$telefone2 = $dados[$i]['telefone2'];
			$email_pro = $dados[$i]['email_pro'];
			$cargo = $dados[$i]['cargo'];
			$salario_bruto = $dados[$i]['salario_bruto'];
			$turno = $dados[$i]['turno'];
			$obs = $dados[$i]['obs'];
			$contrato = $dados[$i]['contrato'];
			$matricula_veiculo = $dados[$i]['matricula_veiculo'];
			$dificienca = $dados[$i]['dificienca'];
			$num_dependentes = $dados[$i]['num_dependentes'];
			$sexo = $dados[$i]['sexo'];
			$foto = $dados[$i]['foto'];

			?>
			<tr>
				<td><a title="Consultar Dados" href="index.php?acao=<?php echo $pagina ?>&funcao=consulta&id=<?php echo $id ?>" style="text-decoration:none"><?php echo $nome ?></a> </td>
				<td><?php echo $email ?></td>
				<td><?php echo $morada ?></td>
				<td><?php echo $telefone ?></td>
				<td><a href="img/<?php echo $foto ?>" target="_blank"><img src="img/<?php echo $foto ?>" width="30px"></a></td>
				<td class="text-right">
					<a type="button" class="btn btn-sm btn-secondary" title="Editar Dados" href="index.php?acao=<?php echo $pagina ?>&funcao=editar&id=<?php echo $id ?>"><i class="fas fa-pencil-alt"></i></a>
					<a type="button" class="btn btn-sm btn-danger" title="Eliminar Dados" href="index.php?acao=<?php echo $pagina ?>&funcao=excluir&id=<?php echo $id ?>"><i class="fas fa-trash-alt"></i></a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table> 
<script src="../plugins/table/datatable/datatables.js"></script>
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

<script src="../assets/js/custom.js"></script>
