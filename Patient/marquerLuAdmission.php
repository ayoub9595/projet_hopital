<?php
$idAd = $_GET["idAd"];
require_once "../connection.php";

$req=$conn->prepare("update admission set Vu=1 where idAd = ?");
$req->execute(array($idAd));
header("location:adm_consult_clinique.php");
?>