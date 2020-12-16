<?php

require_once("../../conex.php"); 
$agora = date('Y-m-d');


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
@$telefone_emergencia = $_POST['telefone_emergencia'];
@$nome_emergencia = $_POST['nome_emergencia'];
@$parentesco_emergencia = $_POST['parentesco_emergencia'];
@$grau_ensino = $_POST['grau_ensino'];
@$curso = $_POST['curso'];
@$instituicao_formacao = $_POST['instituicao_formacao'];
@$nome_banco = $_POST['nome_banco'];
@$iban = $_POST['iban'];
@$bic_swift = $_POST['bic_swift'];
@$codigo_colaborador = $_POST['codigo_colaborador'];
@$telefone2 = $_POST['telefone2'];
@$email_pro = $_POST['email_pro'];
@$cargo = $_POST['cargo'];
@$salario_bruto = $_POST['salario_bruto'];
@$turno = $_POST['turno'];
@$obs = $_POST['obs'];
@$contrato = $_POST['contrato'];
@$matricula_veiculo = $_POST['matricula_veiculo'];
@$dificienca = $_POST['dificienca'];
@$num_dependentes = $_POST['num_dependentes'];
@$sexo = $_POST['sexo'];


//SCRIPT PARA FOTO NO BANCO
@$caminho = '../img/' .$_FILES['foto']['name'];
    if (@$_FILES['foto']['name'] == ""){
      $imagem = "a.png";
    }else{
      $imagem = @$_FILES['foto']['name']; 
    }
    
    $imagem_temp = @$_FILES['foto']['tmp_name']; 
    move_uploaded_file($imagem_temp, $caminho);

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

//creating employeeid
//$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVXWYZ';
//$teste = substr(str_shuffle($permitted_chars), 0, 10);

$length = 10;
$str = '1234567890ABCDE';
  
$teste = substr(str_shuffle($str), 0, $length);

//criar número de colaborador
		$letras = '';
		$numeros = '';
		foreach (range('A', 'Z') as $char) {
		    $letras .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numeros .= $i;
		}
		$colaborador_id = substr(str_shuffle($letras), 0, 3).substr(str_shuffle($numeros), 0, 9);

//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("SELECT * from colaboradores where nif = '$nif'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($nome == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	

	if($linhas == 0){

	$res = $pdo->prepare("INSERT into colaboradores (nome, data_nascimento, idade, estado_civil, nacionalidade, morada, email, telefone, bilhete, nif, nss, carta_conducao, telefone_emergencia, nome_emergencia, parentesco_emergencia, grau_ensino, curso, instituicao_formacao, nome_banco, iban, bic_swift, codigo_colaborador, telefone2, email_pro, cargo, salario_bruto, turno, obs, contrato, matricula_veiculo, dificienca, num_dependentes, sexo, foto) values (:nome, :data_nascimento, :idade, :estado_civil, :nacionalidade, :morada, :email, :telefone, :bilhete, :nif, :nss, :carta_conducao, :telefone_emergencia, :nome_emergencia, :parentesco_emergencia, :grau_ensino, :curso, :instituicao_formacao, :nome_banco, :iban, :bic_swift, :codigo_colaborador, :telefone2, :email_pro, :cargo, :salario_bruto, :turno, :obs, :contrato, :matricula_veiculo, :dificienca, :num_dependentes, :sexo, :foto) ");

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
		$res->bindValue(":codigo_colaborador", $colaborador_id);
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
		$res->bindValue(":foto", $imagem);
		$res->execute();

$res = $pdo->prepare("INSERT into usuarios (nome, usuario, senha, senha_original, cargo) values (:nome, :usuario, :senha, :senha_original, :cargo) ");

		$res->bindValue(":nome", $nome);
		$res->bindValue(":usuario", $email);
		$nif = preg_replace('/[^0-9]/', '', $nif);
		$res->bindValue(":senha", md5($nif));
		$res->bindValue(":senha_original", $nif);
		$res->bindValue(":cargo", $cargo);

		$res->execute();

	echo "Registrado com sucesso";
	exit();
}else{
	echo "Dados de registro duplicados!";
	
}

?>
