<?php

require_once("../../conex.php");
$pagina = 'ausencias';
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$txtpesquisar = @$_POST['txtpesquisar'];

$agora = date('Y-m-d');

echo '
<table class="table mt-3">
	<thead>
		<tr>
			<th>Colaborador</th>
            <th>Tipo</th>
            <th>Dia(s)</th>
            <th>Hora(s)</th>
            <th>Data</th>
            <th>Estado</th>
            <th class="text-right"></th>
		</tr>
	</thead>
	<tbody>';


	$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
	$res = $pdo->query("SELECT * from ausencias where (estado LIKE '$txtpesquisar' or titulo LIKE '$txtpesquisar') and (data >= '$dataInicial' and data <= '$dataFinal') order by id DESC LIMIT 7");
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {

			}
			$id = $dados[$i]['id'];	
			$colaborador = $dados[$i]['colaborador'];
			$dt_inicio = $dados[$i]['dt_inicio'];
			$dt_final = $dados[$i]['dt_final'];
			$titulo = $dados[$i]['titulo'];
			$estado = $dados[$i]['estado'];
			$data = $dados[$i]['data'];
			$dt1 = implode('/', array_reverse(explode('-', $dt_inicio)));
			$dt2 = implode('/', array_reverse(explode('-', $dt_final)));
			$dt11 = implode('/', array_reverse(explode('-', $data)));


            // Calcula a diferença em segundos entre as datas
            $diferenca = strtotime($dt_final) - strtotime($dt_inicio);

            //Calcula a diferença em dias
            $dias = floor($diferenca / (60 * 60 * 24));

            $dt1 = $dt_inicio;
           $timestamp = strtotime($dt1);
           $dat1 = date("d-m-Y", $timestamp);

           $dt2 = $dt_final;
           $timestamp = strtotime($dt2);
           $dat2 = date("d-m-Y", $timestamp);

           $dt3 = $dt_final;
           $timestamp = strtotime($dt3);
           $dat3 = date("H:i", $timestamp);

           $dt4 = $dt_inicio;
           $timestamp = strtotime($dt4);
           $dat4 = date("H:i", $timestamp);


            //Calcula o tempo de upload
            $entrada = $dat4;
            $saida = $dat3;
            $hora1 = explode(":",$entrada);
            $hora2 = explode(":",$saida);
            @$acumulador1 = ($hora1[0] * 3600) + ($hora1[1] * 60) + $hora1[2];
            @$acumulador2 = ($hora2[0] * 3600) + ($hora2[1] * 60) + $hora2[2];
            $resultado = $acumulador2 - $acumulador1;
            $hora_ponto = floor($resultado / 3600);
            $resultado = $resultado - ($hora_ponto * 3600);
            $min_ponto = floor($resultado / 60);
            $resultado = $resultado - ($min_ponto * 60);
            $secs_ponto = $resultado;
            //Grava na variável resultado final
            $tempo = $hora_ponto.":".$min_ponto.":".$secs_ponto;

            

//BUSCAR O TIPO DE ATENDIMENTO
    
	$res_med = $pdo->query("SELECT * from colaboradores where id = '$colaborador'");
	$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_med);

	if($linhas > 0){

		$nome_c = $dados_med[0]['nome'];	

	}

	$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
	$res_t = $pdo->query("SELECT * from colaboradores where nome = '$nome_c' order by id asc");

	echo '<tr>
				<td>' .$nome_c.' </td>
				<td>' .$titulo.' </td>
				<td style="cursor: pointer;" title=" '.$dat1.'&emsp;'.$dat2.'">' .$dias.' </td>
				<td>' .$tempo. ' </td>
				<td>' .$dt11. ' </td>
				<td>';

				if(($estado != 'Aprovado') && ($estado != 'Pendente') && ($estado != 'Em Revisão')){

				  echo '
					<span class="text-danger"><b>'.$estado.'</b></span>';

				  }elseif(($estado != 'Aprovado') && ($estado != 'Pendente') && ($estado != 'Recusado')){
				  echo '
				    <span class="text-info"><b>'.$estado.'</b></span></td>';

				  }elseif(($estado != 'Aprovado') && ($estado != 'Em Revisão') && ($estado != 'Recusado')){
				   echo '
				   <span class="text-warning"><b>'.$estado.'</b></span></td>';	
				 }elseif(($estado != 'Pendente') && ($estado != 'Em Revisão') && ($estado != 'Recusado')){
				 	echo '
				   <span class="text-success"><b>'.$estado.'</b></span></td>';
				 }		

			if(($estado != 'Aprovado') && ($estado != 'Recusado')){
			echo '
				<td class="text-right">
					<a type="button" class="btn btn-sm btn-secondary" title="Editar Dados" href="index.php?acao='.$pagina.'&funcao=consulta&id='.$id.'"><i class="fas fa-pencil-alt"></i></a>&emsp;
					<a type="button" class="btn btn-sm btn-danger" title="Eliminar Dados" href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-trash-alt"></i></a>
				</td>';
			}else{
				echo '
				<td class="text-right"> </div>';
			}
			echo '
			</tr>';
	}
echo '
	</tbody>
</table> ';

?>


