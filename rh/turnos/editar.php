<?php

require_once("../../conex.php"); 

$id = $_POST['id'];
$entrada = date('H:i:s', strtotime($entrada));
$saida = $_POST['saida'];
$saida = date('H:i:s', strtotime($saida));


$res = $pdo->prepare("UPDATE turnos set entrada = :entrada, saida = :saida where id = :id ");

$res->bindValue(":id", $id);
$res->bindValue(":entrada", $entrada);
$res->bindValue(":saida", $saida);


$res->execute();

echo "Atualizado com sucesso";

?>
