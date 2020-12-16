<?php

require_once("../../conex.php"); 

$id = $_POST['id'];
$estado = $_POST['estado'];

$res = $pdo->prepare("UPDATE ausencias set estado = :estado where id = :id ");

$res->bindValue(":estado", $estado);
$res->bindValue(":id", $id);


$res->execute();

echo "Atualizado com sucesso";

?>
