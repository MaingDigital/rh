<?php

require_once("../../conex.php");

	$nif = $_POST['nif'];
	$obs = $_POST['obs'];


	$res = $pdo->prepare("UPDATE colaboradores set obs = :obs where nif = :nif ");

	$res->bindValue(":nif", $nif);
	$res->bindValue(":obs", $obs);
	$res->execute();

	echo "Atualizado com sucesso";

	?>
