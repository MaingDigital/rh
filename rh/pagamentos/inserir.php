<?php 

require_once("../../conex.php");
@session_start();

$nome_funcionario = $_POST['nome_funcionario'];
$tesoureiro = $_POST['tesoureiro'];
$funcionario = $_POST['funcionario'];
$valor = $_POST['valor'];
$inss = $_POST['inss'];
$s_ferias = $_POST['s_ferias'];
$s_natal = $_POST['s_natal'];
$abono_f = $_POST['abono_f'];
$s_alimento = $_POST['s_alimento'];
$s_trans = $_POST['s_trans'];
$a_falha = $_POST['a_falha'];
$s_renda = $_POST['s_renda'];
$s_desl = $_POST['s_desl'];
$tipo_desc = $_POST['tipo_desc'];
$desconto = $_POST['desconto'];
$tipo_premio = $_POST['tipo_premio'];
$premio = $_POST['premio'];
$excesso = $_POST['excesso'];
$tx_fixa = $_POST['tx_fixa'];
$irt = $_POST['irt'];
$salario = $_POST['salario'];
$estado = $_POST['estado'];
$s_noite = $_POST['s_noite'];
$h_extras = $_POST['h_extras'];





$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("SELECT * from colaboradores where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['nif'];


//BUSCAR O NOME DO FUNCIONÁRIO)
$res = $pdo->query("SELECT * from colaboradores where nif = '$funcionario'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$nome_funcionario= $dados[0]['nome'];



if($funcionario == ''){
	echo "Escolha um Funcionário!!";
	exit();
}

if($valor == ''){
	echo "Preencha o Valor!";
	exit();
}


//Não pagam INSS nem IRT
$ferias = $valor * $s_ferias;
$familia = $valor * $abono_f;


//Paga INSS mas não paga irt
$natal = $valor * $s_natal;

//Subisidios que sofrem desconto de INSS e IRT
$alimentacao = $valor * $s_alimento;
$transporte = $valor * $s_trans;
$falha = $valor * $a_falha;
$renda = $valor * $s_renda;
$sub_noite = $valor * $s_noite;




if ($alimentacao <= '30000'){
	@$ali1 = '0';
} else {
	@$ali1 = $alimentacao - '30000' ;
}

if ($transporte <= '30000'){
	@$trans1 = '0';
} else {
	@$trans1 = $transporte - '30000';
}

//Verificar se o valor da falha é igual a 5% do salario base, caso não, o excesso é adicionado ao IRT

if ($falha <= $valor * '0.05'){
	@$falha1 = '0';
} else {
	@$falha1 = $falha - ($valor * '0.05');
}

//Verificar se o valor da renda é igual a metade do salario base, caso não, o excesso é adicionado ao IRT

if ($renda <= $valor / '2' ){
	@$renda1 = '0';
} else {
	@$renda1 = $renda - ($valor / '2');
}

if ($s_desl <= '33125'){
	@$deslocacao1 = '0';
} else {
	@$deslocacao1 = $s_desl - '33125' ;
}

if ($sub_noite <= '0'){
	@$sub_noite1 = '0';
} else {
	@$sub_noite1 = $sub_noite;
}



@$excesso_t = $ali1 + $trans1 + $falha1 + $renda1 + $deslocacao1 + $sub_noite1;

// irt = valor depois do INSS - subsidios + excesso
// 550000 - 97 + excesso 20, 

//Calculo do valor do Base + os subsidios para o INSS
@$valor_inss = $valor + $natal + $alimentacao + $transporte + $falha + $renda + $s_desl + $premio - $desconto + $sub_noite;


//Verificação da percentagem do INSS
@$valor_inss1 = $valor_inss * $inss;

//Salário após retirada do INSS
@$salario_basico = $valor_inss - $valor_inss1;

//Total de Subsidios
@$total_subsidios = $alimentacao + $transporte + $falha + $renda + $s_desl + $sub_noite;
//Valor sem ecesso nos subsidios
@$valor_sem_excesso = $total_subsidios - $excesso_t; 

//Subtrair o Valor base e o valor dos subsidios sem excessos
@$escalao_irt = $valor_inss - $valor_inss1 - $total_subsidios + $excesso_t;

if ($escalao_irt <= '70000'){
	@$descalao_irt1 = '0';
	@$taxa_fixa = '0';
	@$excesso_de = '0';
} elseif ($escalao_irt >= '70001' && $escalao_irt <= '100000') {
	@$descalao_irt1 = '0.10';
	@$taxa_fixa = '3000';
	@$excesso_de = '70000';
}elseif ($escalao_irt >= '100001' && $escalao_irt <= '150000') {
	@$descalao_irt1 = '0.13';
	@$taxa_fixa = '6000';
	@$excesso_de = '100000';
}elseif ($escalao_irt >= '150001' && $escalao_irt <= '200000') {
	@$descalao_irt1 = '0.16';
	@$taxa_fixa = '12500';
	@$excesso_de = '150000';
}elseif ($escalao_irt >= '200001' && $escalao_irt <= '300000') {
	@$descalao_irt1 = '0.18';
	@$taxa_fixa = '31250';
	@$excesso_de = '200000';
}elseif ($escalao_irt >= '300001' && $escalao_irt <= '500000') {
	@$descalao_irt1 = '0.19';
	@$taxa_fixa = '49250';
	@$excesso_de = '300000';
}elseif ($escalao_irt >= '500001' && $escalao_irt <= '1000000') {
	@$descalao_irt1 = '0.20';
	@$taxa_fixa = '87250';
	@$excesso_de = '500000';
}elseif ($escalao_irt >= '1000001' && $escalao_irt <= '1500000') {
	@$descalao_irt1 = '0.21';
	@$taxa_fixa = '187250';
	@$excesso_de = '1000000';
}elseif ($escalao_irt >= '150001' && $escalao_irt <= '2000000') {
	@$descalao_irt1 = '0.22';
	@$taxa_fixa = '292000';
	@$excesso_de = '1500000';
}elseif ($escalao_irt >= '2000001' && $escalao_irt <= '2500000') {
	@$descalao_irt1 = '0.23';
	@$taxa_fixa = '402250';
	@$excesso_de = '2000000';
}elseif ($escalao_irt >= '2500001' && $escalao_irt <= '5000000') {
	@$descalao_irt1 = '0.24';
	@$taxa_fixa = '517250';
	@$excesso_de = '2500000';
}elseif ($escalao_irt >= '5000001' && $escalao_irt <= '10000000') {
	@$descalao_irt1 = '0.25';
	@$taxa_fixa = '1117250';
	@$excesso_de = '5000000';
}elseif ($escalao_irt >= '10000001') {
	@$descalao_irt1 = '0.25';
	@$taxa_fixa = '2342250';
	@$excesso_de = '10000000';
}


@$taxa_percentual = $escalao_irt - $excesso_de ;

@$total_irt = $descalao_irt1 * $taxa_percentual;

@$total = $taxa_fixa + $total_irt;

@$salario_total = $salario_basico - $total + $ferias + $familia + $h_extras;

@$encargo_empresa = $valor_inss * '0.08';

	$res = $pdo->prepare("INSERT into pagamentos (funcionario, valor, tesoureiro, data, nome_funcionario, inss, s_ferias, s_natal, abono_f, s_alimento, s_trans, a_falha, s_renda, s_desl, tipo_desc, desconto, tipo_premio, premio, excesso, tx_fixa, escalao, excesso_dee, percent, irt, salario, estado, enc_empresa, s_noite, h_extras ) values (:funcionario, :valor, :tesoureiro, curDate(), :nome_funcionario, :inss, :s_ferias, :s_natal, :abono_f, :s_alimento, :s_trans, :a_falha, :s_renda, :s_desl, :tipo_desc, :desconto, :tipo_premio, :premio, :excesso, :tx_fixa, :escalao, :excesso_dee, :percent, :irt, :salario, :estado, :enc_empresa, :s_noite, :h_extras )");

	$res->bindValue(":funcionario", $funcionario);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":tesoureiro", $func);
	$res->bindValue(":nome_funcionario", $nome_funcionario);
	$res->bindValue(":inss", $valor_inss1);
	$res->bindValue(":s_ferias", $ferias);
	$res->bindValue(":s_natal", $natal);
	$res->bindValue(":abono_f", $familia);
	$res->bindValue(":s_alimento", $alimentacao);
	$res->bindValue(":s_trans", $transporte);
	$res->bindValue(":a_falha", $falha);
	$res->bindValue(":s_renda", $renda);
	$res->bindValue(":s_desl", $s_desl);
	$res->bindValue(":tipo_desc", $tipo_desc);
	$res->bindValue(":desconto", $desconto);
	$res->bindValue(":tipo_premio", $tipo_premio);
	$res->bindValue(":premio", $premio);
	$res->bindValue(":excesso", $excesso_t);
	$res->bindValue(":tx_fixa", $taxa_fixa);
	$res->bindValue(":escalao", $escalao_irt);
	$res->bindValue(":excesso_dee", $excesso_de);
	$res->bindValue(":percent", $descalao_irt1);
	$res->bindValue(":irt", $total);
	$res->bindValue(":estado", 'Pendente');
	$res->bindValue(":enc_empresa", $encargo_empresa);
	$res->bindValue(":salario", $salario_total);
	$res->bindValue(":s_noite", $sub_noite);
	$res->bindValue(":h_extras", $h_extras);


	$res->execute();





//LANÇAR NA TABELA DE MOVIMENTAÇÕES

//$res_valor = $pdo->query("SELECT * from pagamentos order by id desc limit 1");
//$dados_valor  = $res_valor ->fetchAll(PDO::FETCH_ASSOC);
//$id_pgto = $dados_valor [0]['id'];

//$res = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_movimento) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_movimento)");

//$res->bindValue(":tipo", 'Saída');
//$res->bindValue(":movimento", 'Pgto Funcionário');
//$res->bindValue(":valor", $valor);
//$res->bindValue(":tesoureiro", $func);
//$res->bindValue(":id_movimento", $id_pgto);

//$res->execute();

	echo "Cadastrado com Sucesso!!";



?>