<?php

require_once("../../conex.php"); 

@$nome = $_POST['nome'];
$cod_med = $_POST['cod_med'];
$num_ambulatorio = $_POST['num_ambulatorio'];
@$especialidade = $_POST['especialidade'];
$num_cedula = $_POST['num_cedula'];
@$turno = $_POST['turno'];
$info = $_POST['info'];
$email = $_POST['email'];

//Verificar se o utilizador já está registado
$res_c = $pdo->query("SELECT * from medicos where cod_med = '$cod_med' ");
$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_c);
	if ($nome == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($cod_med == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($num_ambulatorio == '') {
		echo 'Preencha os dados em falta';
		exit();
	} 
	if ($especialidade == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($num_cedula == '') {
		echo 'Preencha os dados em falta';
		exit();
	}


if ($linhas == 0) {
//Insert para inserir os dados na DB	
	$res = $pdo->prepare("INSERT into medicos (nome, cod_med, num_ambulatorio, especialidade, num_cedula, turno, info, email) values (:nome, :cod_med, :num_ambulatorio, :especialidade, :num_cedula, :turno, :info, :email) ");

	$res->bindValue(":nome", $nome);
	$res->bindValue(":cod_med", $cod_med);
	$res->bindValue(":num_ambulatorio", $num_ambulatorio);
	$res->bindValue(":especialidade", $especialidade);
	$res->bindValue(":num_cedula", $num_cedula);
	$res->bindValue(":turno", $turno);
	$res->bindValue(":info", $info);
	$res->bindValue(":email", $email);
	$res->execute();

		//echo "<script language='javascript'>window.alert('Registrado com sucesso!'); </script>";
	echo "Registrado com sucesso";
}else{
	echo "Dados de registro duplicados!";
	
}

?>
