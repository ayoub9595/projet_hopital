<?php
$idAd = $_GET["idAd"];
require_once "../connection.php";

$req=$conn->prepare("update admission set Archive=1 where idAd = ?");
$req->execute(array($idAd));
header("location:liste_adm_jour.php");
?>