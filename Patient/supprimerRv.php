<?php
$idAd = $_GET["idR"];
require_once "../connection.php";

$req=$conn->prepare("update rv set Archive=1 where idRv = ?");
$req->execute(array($idAd));
header("location:adm_consult_clinique.php");
?>