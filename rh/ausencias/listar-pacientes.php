<?php 

require_once("../../conexao.php");
$pagina = 'ausencias';

$txtpesquisar = @$_POST['txtpesquisar'];


if ($txtpesquisar != ''){

echo '
<table class="table tabela table-hover mt-3 tabelas">
	<thead">
		<tr>
			<th scope="col">Nome</th>
			<th scope="col">Nif</th>
			<th scope="col">Telefone</th>			
			<th scope="col">Ações</th>
		</tr>
	</thead>
	<tbody>';

	
	    

	
	$txtpesquisar = '%'.@$_POST['txtpesquisar-paciente'].'%';
	$res = $pdo->query("SELECT * from pacientes where nif LIKE '$txtpesquisar' or nome LIKE '$txtpesquisar' order by id desc limit 1");

	
	
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);

	for ($i=0; $i < count($dados); $i++) { 
			foreach ($dados[$i] as $key => $value) {
			}

			$id = $dados[$i]['id'];	
			$nome = $dados[$i]['nome'];
			$nif = $dados[$i]['nif'];
			$num_bi = $dados[$i]['num_bi'];
			$telefone = $dados[$i]['telefone'];
			$email = $dados[$i]['email'];
			$endereco = $dados[$i]['endereco'];			
			$data_nasc = $dados[$i]['data_nasc'];
			$idade = $dados[$i]['idade'];
			$estado_civil = $dados[$i]['estado_civil'];
			$sexo = $dados[$i]['sexo'];
			$obs = $dados[$i]['obs'];
			

echo '
		<tr>

			
			<td>'.$nome.'</td>
			<td>'.$nif.'</td>
			<td>'.$telefone.'</td>
			<td><a id="btn-selecionar" style="cursor: pointer;"><i class="fas fa-check-circle text-success"></i></a></td>
			
			
		</tr>';

	}

echo  '
	</tbody>
</table> ';


}



?>





<script type="text/javascript">
	$(document).ready(function(){
	
		$('#btn-selecionar').click(function(event){
			event.preventDefault();
			
			var id = "<?=$id?>";
			var nome = "<?=$nome?>";

			document.getElementById('txtpesquisar-paciente').value = nome;
			document.getElementById('id').value = id;

			document.getElementById("listar-pacientes").style.display = "none";
			//document.getElementById('txtbuscar-paciente').value = '';


		})
	})
</script>
