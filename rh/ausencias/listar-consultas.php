<?php

require_once("../../conexao.php");
$pagina = 'marcacoes';

$txtpesquisar = @$_POST['txtpesquisar'];

echo '
<table class="table tabela table-hover table-bordered table-sm mt-3 tabelas">
	<thead class="thead">
		<tr>
			<th scope="col">Paciente</th>
			<th scope="col">Hora</th>
			<th scope="col">Consulta ou Exame</th>
			<th scope="col">Médico</th>
		</tr>
	</thead>
	<tbody>';



	if($txtpesquisar == ''){
	$res = $pdo->query("SELECT * from consultas where data = curDate() order by hora desc Limit 10");
}else{
	$txtpesquisar = @$_POST['txtpesquisar'];
	$res = $pdo->query("SELECT * from consultas where data = '$txtpesquisar'  order by hora desc Limit 10");
}	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {

			}
			$id = $dados[$i]['id'];	
			$paciente = $dados[$i]['paciente'];
			$hora = $dados[$i]['hora'];
			$tipo_atendimento = $dados[$i]['tipo_atendimento'];
			$medico = $dados[$i]['medico'];
			$valor = $dados[$i]['valor'];
			$pgto_confirmado = $dados[$i]['pgto_confirmado'];

	//BUSCAR O NOME DO PACIENTE
	$res_valor = $pdo->query("SELECT * from pacientes where id = '$paciente'");
	$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_valor);

	if($linhas > 0){

		$nome_paciente = $dados_valor[0]['nome'];	

	}


	//BUSCAR O NOME DO MÉDICO
	$res_med = $pdo->query("SELECT * from medicos where id = '$medico'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$nome_medico = $dados_med[0]['nome'];	

	}



	//BUSCAR O TIPO DE ATENDIMENTO
	$res_med = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$atendimento = $dados_med[0]['descricao'];	

	}

	echo '<tr>
				<td>' .$nome_paciente.' </td>
				<td>' .$hora.' </td>
				<td>' .$atendimento.' </td>
				<td>' .$nome_medico.' </td>
			</tr>';
	}
echo '
	</tbody>
</table> ';

?>


