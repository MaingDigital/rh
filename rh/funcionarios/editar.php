<?php

require_once("../../conex.php"); 


$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$estado_civil = $_POST['estado_civil'];
$nacionalidade = $_POST['nacionalidade'];
$morada = $_POST['morada'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$bilhete = $_POST['bilhete'];
$nif = $_POST['nif'];
$nss = $_POST['nss'];
$carta_conducao = $_POST['carta_conducao'];
$telefone_emergencia = $_POST['telefone_emergencia'];
$nome_emergencia = $_POST['nome_emergencia'];
$parentesco_emergencia = $_POST['parentesco_emergencia'];
$grau_ensino = $_POST['grau_ensino'];
$curso = $_POST['curso'];
$instituicao_formacao = $_POST['instituicao_formacao'];
$nome_banco = $_POST['nome_banco'];
$iban = $_POST['iban'];
$bic_swift = $_POST['bic_swift'];
$codigo_colaborador = $_POST['codigo_colaborador'];
$telefone2 = $_POST['telefone2'];
$email_pro = $_POST['email_pro'];
$cargo = $_POST['cargo'];
$salario_bruto = $_POST['salario_bruto'];
$turno = $_POST['turno'];
$obs = $_POST['obs'];
$contrato = $_POST['contrato'];
$matricula_veiculo = $_POST['matricula_veiculo'];
$dificienca = $_POST['dificienca'];
$num_dependentes = $_POST['num_dependentes'];
$sexo = $_POST['sexo'];
$id = $_POST['id'];
$nif_antigo = $_POST['nif_antigo'];




//CALCULAR A IDADE COM BASE NA DATA SELECIONADA

if($data_nascimento != ''){
	// separando yyyy, mm, ddd
	list($ano, $mes, $dia) = explode('-', $data_nascimento);

    // data atual
	$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    // Descobre a unix timestamp da data de nascimento do fulano
	$nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

    // cálculo
	$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
}else{
	$idade = 0;
}

if ($nif_antigo != $nif) {
	//Verificar se o utilizador já está registado somente se for alterado o utilizador

	$res_c = $pdo->query("SELECT * from colaboradores where nif = '$nif' ");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($linhas != 0) {

		echo "Dados de registro duplicados!";
		exit();
	}
}


	//UPDATE para atualizar os dados na DB	
	$res = $pdo->prepare("UPDATE  colaboradores set nome = :nome, data_nascimento = :data_nascimento, idade = :idade, estado_civil = :estado_civil, nacionalidade = :nacionalidade, morada = :morada, email = :email, telefone = :telefone, bilhete = :bilhete, nif = :nif, nss = :nss, carta_conducao = :carta_conducao, telefone_emergencia = :telefone_emergencia, nome_emergencia = :nome_emergencia, parentesco_emergencia = :parentesco_emergencia, grau_ensino = :grau_ensino, curso = :curso, instituicao_formacao = :instituicao_formacao, nome_banco = :nome_banco, iban = :iban, bic_swift = :bic_swift, codigo_colaborador = :codigo_colaborador, telefone2 = :telefone2, email_pro = :email_pro, cargo = :cargo, salario_bruto = :salario_bruto, turno = :turno, obs = :obs, contrato = :contrato, matricula_veiculo = :matricula_veiculo, dificienca = :dificienca, num_dependentes = :num_dependentes, sexo = :sexo where id = :id ");

		$res->bindValue(":nome", $nome);
		$res->bindValue(":data_nascimento", $data_nascimento);
		$res->bindValue(":idade", $idade);
		$res->bindValue(":estado_civil", $estado_civil);
		$res->bindValue(":nacionalidade", $nacionalidade);
		$res->bindValue(":morada", $morada);
		$res->bindValue(":email", $email);
		$res->bindValue(":telefone", $telefone);
		$res->bindValue(":bilhete", $bilhete);
		$res->bindValue(":nif", $nif);
		$res->bindValue(":nss", $nss);
		$res->bindValue(":carta_conducao", $carta_conducao);
		$res->bindValue(":telefone_emergencia", $telefone_emergencia);
		$res->bindValue(":nome_emergencia", $nome_emergencia);
		$res->bindValue(":parentesco_emergencia", $parentesco_emergencia);
		$res->bindValue(":grau_ensino", $grau_ensino);
		$res->bindValue(":curso", $curso);
		$res->bindValue(":instituicao_formacao", $instituicao_formacao);
		$res->bindValue(":nome_banco", $nome_banco);
		$res->bindValue(":iban", $iban);
		$res->bindValue(":bic_swift", $bic_swift);
		$res->bindValue(":codigo_colaborador", $codigo_colaborador);
		$res->bindValue(":telefone2", $telefone2);
		$res->bindValue(":email_pro", $email_pro);
		$res->bindValue(":cargo", $cargo);
		$res->bindValue(":salario_bruto", $salario_bruto);
		$res->bindValue(":turno", $turno);
		$res->bindValue(":obs", $obs);
		$res->bindValue(":contrato", $contrato);
		$res->bindValue(":matricula_veiculo", $matricula_veiculo);
		$res->bindValue(":dificienca", $dificienca);
		$res->bindValue(":num_dependentes", $num_dependentes);
		$res->bindValue(":sexo", $sexo);
		$res->bindValue(":id", $id);
		$res->execute();

echo "Atualizado com sucesso";

?>
