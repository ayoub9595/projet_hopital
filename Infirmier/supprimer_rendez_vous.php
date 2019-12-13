<?php
$idR = $_GET["idR"];
require_once "../connection.php";

$req=$conn->prepare("update rv set Archive=1 where idRV = ?");
$req->execute(array($idR));
header("location:liste_rendez_vous.php");
?>