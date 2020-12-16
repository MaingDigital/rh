<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/custom_dt_html5.css">
<link rel="stylesheet" type="text/css" href="../plugins/table/datatable/dt-global_style.css">

<?php

require_once("../../conex.php");
$pagina = 'cargos';

?>
<table id="html5-extension" class="table table-hover non-hover" style="position: relative; z-index: 100;">
	<thead style="position: relative; z-index: 100;">
		<tr>
			<th scope="col">Nº</th>
			<th scope="col">Cargo</th>
			<th scope="col" class="text-right">Ações</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$txtpesquisar = @$_POST['txtpesquisar'];

		if($txtpesquisar == ''){
		$res = $pdo->query("SELECT * from cargos order by id");
	}else{
		$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
		$res = $pdo->query("SELECT * from cargos  where cargo LIKE '$txtpesquisar' order by id asc");
	}
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from cargos");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {

			}
			$id = $dados[$i]['id'];	
			$cargo = $dados[$i]['cargo'];
			?>
			<tr>
				<td><?php echo $id ?></td>
				<td><?php echo $cargo ?></td>

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


