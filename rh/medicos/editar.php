<?php

require_once("../../conex.php"); 


$nome = $_POST['nome'];
$cod_med = $_POST['cod_med'];
$num_ambulatorio = $_POST['num_ambulatorio'];
$especialidade = $_POST['especialidade'];
$num_cedula = $_POST['num_cedula'];
$turno = $_POST['turno'];
$info = $_POST['info'];
$email = $_POST['email'];
$id = $_POST['id'];
$cod_med_antigo = $_POST['cod_med_antigo'];

if ($cod_med_antigo != $cod_med) {
	//Verificar se o utilizador já está registado somente se for alterado o utilizador

	$res_c = $pdo->query("SELECT * from medicos where cod_med = '$cod_med' ");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($linhas != 0) {

		echo "Dados de registro duplicados!";
		exit();
	}
}


	//UPDATE para atualizar os dados na DB	
$res = $pdo->prepare("UPDATE  medicos set nome = :nome, cod_med = :cod_med, num_ambulatorio = :num_ambulatorio, especialidade = :especialidade, num_cedula = :num_cedula, turno = :turno, info = :info, email = :email where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":cod_med", $cod_med);
$res->bindValue(":num_ambulatorio", $num_ambulatorio);
$res->bindValue(":especialidade", $especialidade);
$res->bindValue(":num_cedula", $num_cedula);
$res->bindValue(":turno", $turno);
$res->bindValue(":info", $info);
$res->bindValue(":email", $email);
$res->bindValue(":id", $id);
$res->execute();

echo "Atualizado com sucesso";

?>
