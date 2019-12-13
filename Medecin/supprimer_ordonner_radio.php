<?php
$id = $_GET["id"];
require_once "../connection.php";
$req = $conn->prepare("update prescription set Archive=1 where idPres = ?");
$req->execute(array($id));
header("location:liste_ordonner_radio.php");
?>