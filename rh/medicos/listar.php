<?php

require_once("../../conex.php");
$pagina = 'medicos';

$txtpesquisar = @$_POST['txtpesquisar'];

echo '
<table class="table mt-3">
	<thead>
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">Código Médico</th>
			<th scope="col">Especialidade</th>
			<th scope="col">Nº de Cédula</th>
			<th scope="col">Turno</th>
			<th scope="col" class="text-right">Ações</th>
		</tr>
	</thead>
	<tbody>';

	$itens_por_pagina = $_POST['itens'];

	//PEGAR A PÁGINA ATUAL
	$pagina_pag = intval(@$_POST['pag']);

	$limite = $pagina_pag * $itens_por_pagina;

	//CAMINHO DA PAGINAÇÃO
	$caminho_pag = 'index.php?acao='.$pagina.'&';

	if($txtpesquisar == ''){
		$res = $pdo->query("SELECT * from medicos order by id desc LIMIT $limite, $itens_por_pagina");
	}else{
		$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
		$res = $pdo->query("SELECT * from medicos  where nome LIKE '$txtpesquisar' or cod_med LIKE '$txtpesquisar' order by id desc");
	}
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
		$res_todos = $pdo->query("SELECT * from medicos");
		$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
		$num_total = count($dados_total);

		//DEFINIR O TOTAL DE PAGINAS
		$num_paginas = ceil($num_total/$itens_por_pagina);


	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {

			}
			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$cod_med = $dados[$i]['cod_med'];
			$num_ambulatorio = $dados[$i]['num_ambulatorio'];
			$especialidade = $dados[$i]['especialidade'];
			$num_cedula = $dados[$i]['num_cedula'];
			$turno = $dados[$i]['turno'];
			$info = $dados[$i]['info'];
			$email = $dados[$i]['email'];

			//Resgatar o nome da especialização

			$res_esp = $pdo->query("SELECT * from especializacoes where id = '$especialidade'");
			$dados_esp = $res_esp->fetchAll(PDO::FETCH_ASSOC);
			@$nome_esp = $dados_esp[0]['nome'];


	echo '<tr>
				<td><a title="Consultar Dados" href="index.php?acao='.$pagina.'&func=consulta&id='.$id.'">'.$nome.' </a></td>
				<td>'.$cod_med.'</td>
				<td>'.$nome_esp.'</td>
				<td>'.$num_cedula.'</td>
				<td>'.$turno.'</td>
				<td class="text-right">
					<a type="button" class="btn btn-sm btn-secondary" title="Editar Dados" href="index.php?acao='.$pagina.'&funcao=editar&id='.$id.'"><i class="fas fa-pencil-alt"></i></a>
					<a type="button" class="btn btn-sm btn-danger" title="Eliminar Dados" href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="fas fa-trash-alt"></i></a>
				</td>
			</tr>';
	}
echo '
	</tbody>
</table> ';

if ($txtpesquisar == '') {

echo'
<!--ÁREA DA PÁGINAÇÃO -->
<nav class="paginacao" aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="btn btn-outline-dark btn-sm mr-1" href="'.$caminho_pag.'pagina=0&itens='.$itens_por_pagina.'" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>';
 
            for($i=0;$i<$num_paginas;$i++){
            $estilo = "";
            if($pagina_pag == $i)
              $estilo = "active";
         echo '
             <li class="page-item"><a class="btn btn-outline-dark btn-sm mr-1 '.$estilo.'" href="'.$caminho_pag.'pagina='.$i.'&itens='.$itens_por_pagina.'">'.($i+1).'</a></li>';
           }
            
           echo '<li class="page-item">
              <a class="btn btn-outline-dark btn-sm" href="'.$caminho_pag. 'pagina='.($num_paginas-1).'&itens='.$itens_por_pagina.'" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
</nav>
  

';
}
?>


