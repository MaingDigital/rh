<?php 
@session_start();

require_once("../../conex.php");
$pagina = 'pagamentos';

$txtpesquisar = @$_POST['txtpesquisar'];
$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];

$agora = date('Y-m-d');


$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("SELECT * FROM colaboradores WHERE email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
@$nif_tesoureiro= $dados_excluir[0]['nif'];


 
echo '
<table class="table mt-3" style="font-size: 18px;">
<thead>
<tr>
<th scope="col">Funcionário</th>
<th scope="col" class="text-right">Vencimento</th>
<th scope="col" class="text-center">INSS</th>
<th scope="col" class="text-center">IRT</th>
<th scope="col">Cargo</th>
<th scope="col">Data</th>
<th scope="col">Recibo</th>
<th scope="col" class="text-right"></th>
</tr>
</thead>
<tbody>';

$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
	$res_a = $pdo->query("SELECT * from colaboradores where nome LIKE '$txtpesquisar' order by id asc");


	$txtpesquisar = '%'.@$_POST['txtpesquisar'].'%';
	$res = $pdo->query("SELECT * from pagamentos where (funcionario LIKE '$txtpesquisar' or nome_funcionario LIKE '$txtpesquisar') and tesoureiro = '$nif_tesoureiro' and (data >= '$dataInicial' and data <= '$dataFinal') order by id asc");


$dados = $res->fetchAll(PDO::FETCH_ASSOC);




for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$funcionario = $dados[$i]['funcionario'];
	$valor = $dados[$i]['valor'];
	$salario = $dados[$i]['salario'];
	$data = $dados[$i]['data'];
	$tesoureiro = $dados[$i]['tesoureiro'];
	$nome_funcionario = $dados[$i]['nome_funcionario'];
	$inss = $dados[$i]['inss'];
	$irt = $dados[$i]['irt'];
	$estado = $dados[$i]['estado'];
	$data2 = implode('/', array_reverse(explode('-', $data)));

	@$total = $total + $salario;

	//BUSCAR O NOME DO TESOUREIRO
	$res_excluir = $pdo->query("select * from colaboradores where nif = '$tesoureiro'");
	$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
	$nome_tesoureiro = $dados_excluir[0]['nome'];


	//BUSCAR O NOME DO CARGO DO FUNCIONARIO
	$res_func = $pdo->query("select * from colaboradores where nif = '$funcionario'");
	$dados_func = $res_func->fetchAll(PDO::FETCH_ASSOC);
	$cargo = $dados_func[0]['cargo'];


	echo '
	<tr>


	<td>'.$nome_funcionario.'</td>
	<td class="text-right">' .number_format("$salario",2,",",".").' KZ</td>
	<td class="text-right">' .number_format("$inss",2,",",".").' KZ</td>
	<td class="text-right">' .number_format("$irt",2,",",".").' KZ</td>
	<td>'.$cargo.'</td>
	<td>'.$data2.'</td>';
	if ($estado != 'Aprovado'){
			echo '
	<td class="text-right"> </div>
	
	<td class="text-right">
	<a type="button" class="btn btn-sm btn-success" href="index.php?acao='.$pagina.'&funcao=baixar&id='.$id.'">Aprovar</a>

	 <a type="button" class="btn btn-sm btn-danger" title="Excluir Conta" href="index.php?acao='.$pagina.'&funcao=excluir&id='.$id.'"><i class="far fa-trash-alt"></i></a>

	</td>
	';
		}else{
	echo '
	<td>
	 <a type="button" class="btn btn-primary btn-sm mr-2" title="Comprovativo" target="_blank" href="rel/recibo_class.php?id='.$id.'"><i class="fas fa-print"></i></a>
	</td>

	<td class="text-right"> </div>
	
	</tr>';
			}

}

echo  '
</tbody>
</table>


<div class="float-right totalpago">Total Pago:&emsp; '.number_format("$total",2,",",".").' KZ</div>

 ';

?>