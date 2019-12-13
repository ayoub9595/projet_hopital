<?php
$idAd = $_GET["idR"];
require_once "../connection.php";

$req=$conn->prepare("update rv set Vu=1 where idRV = ?");
$req->execute(array($idAd));
header("location:adm_consult_clinique.php");
echo $idR;
?>