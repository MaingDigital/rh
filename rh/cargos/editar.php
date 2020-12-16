<?php

require_once("../../conex.php"); 

$id = $_POST['id'];
$cargo = $_POST['cargo'];
$campo_antigo = $_POST['campo_antigo'];

//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO SOMENTE SE FOR TROCADO O USUÁRIO
if ($campo_antigo != $cargo) {
	//Verificar se o utilizador já está registado somente se for alterado o utilizador

	$res_c = $pdo->query("SELECT * from cargos where cargo = 'cargo' ");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($linhas != 0) {

		echo "Dados de registro duplicados!";
		exit();
	}
}

$res = $pdo->prepare("UPDATE cargos set cargo = :cargo where id = :id ");

$res->bindValue(":cargo", $cargo);
$res->bindValue(":id", $id);


$res->execute();

echo "Atualizado com sucesso";

?>
