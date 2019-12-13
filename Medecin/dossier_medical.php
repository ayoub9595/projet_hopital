<?php
require "../medecin_partials/begin.php";
require_once "../connection.php";
$req = $conn->prepare("select * from utilisateur where idU = ?");
$req->execute(array($_GET["id"]));
$patients = $req->fetchAll();
$nom = $patients[0]["nom"];
$prenom = $patients[0]["prenom"];
$date_naissance = $patients[0]["date_naissance"];
$cin = $patients[0]["cin"];
$telephone = $patients[0]["tel"];

$req=$conn->prepare("select * from securiteSociale where idP = ?  ");
$req->execute(array($_GET["id"]));
$results = $req->fetchAll();
$sec_sociale = $results[0]["num_sec"];

$req=$conn->prepare("select * from antecendents_medicaux where idP = ?  ");
$req->execute(array($_GET["id"]));
$results = $req->fetchAll();
$antecedents = $results[0]["corps_ant"];

$req= $conn->prepare("select admission.idAd,admission.typeAd,admission.DateDebut,specialite.specialite from admission inner join specialite on admission.idS = specialite.idS where idP =? and etat ='Accepté' ");
$req->execute(array($_GET["id"]));
$consultations = $req->fetchAll();

$req= $conn->prepare("select * from prescription where idP =? and genre ='radio' ");
$req->execute(array($_GET["id"]));
$radios = $req->fetchAll();

$req= $conn->prepare("select * from prescription where idP =? and genre ='medicament' ");
$req->execute(array($_GET["id"]));
$medicaments = $req->fetchAll();
?>

<h1>Dossier medical du patient <?=$nom?> <?=$prenom?> </h1>
<div  class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-body">
                <h2>Volet d'identification</h2>
                <table border="1">
                  <tr><td width="150px"><strong>Nom:</strong></td><td width="150px"><?=$nom ?></td></tr>
                  <tr><td width="150px"><strong>Prenom:</strong></td><td width="150px"><?=$prenom ?></td></tr>
                  <tr><td width="150px"><strong>Date de naissance:</strong></td><td width="150px"><?=$date_naissance ?></td></tr>
                  <tr><td width="150px"><strong>CIN:</strong></td><td width="150px"><?=$cin ?></td></tr>
                  <tr><td width="150px"><strong>Telephone:</strong></td><td width="150px"><?=$telephone ?></td></tr>
                  <tr><td width="150px"><strong>Numero de securité sociale:</strong></td><td width="150px"><?=$sec_sociale ?></td></tr>
                </table >
                <h2>Antecedents medicaux</h2>
                 <?=nl2br($antecedents)?>
                <h2>Historique des consultations</h2>
                <?php $i=1 ?>
                <?php foreach ($consultations as $consultation) { ?>
                  <h3>Consultation<?=$i?>:</h3>
                  <strong>Date de consultation :</strong><br> <?=$consultation["DateDebut"] ?><br>
                  <strong>Type de consultation :</strong><br> <?=$consultation["typeAd"]?><br>
                  <strong>Service :</strong> <?=$consultation["specialite"]?><br>
               <?php $i++;  } ?>
               <h2>Historique des radiographies effectués</h2>
                <?php foreach ($radios as $radio){ ?>
                <?=nl2br($radio["corps"])?><br>
                <?php } ?>
                <h2>Historique des medicaments prescris</h2>
                <?php $j=1 ?>
                <?php foreach ($medicaments as $medicament){ ?>
                    <h3>Prescription<?=$j?></h3>
                    <strong>Date d'ordonnance:</strong><br><?=$medicament["datePres"]?><br>
                    <strong>Medicament prescris:</strong><br><?=nl2br($medicament["corps"])?><br>
                <?php $j++; } ?>
            </div>
        </div>
    </div>
</div>
<style>
    h2{
        color: dodgerblue;
        padding-top: 10px;
    }
    h3{
        color: red;
        padding-top: 10px;
    }
</style>
<?php require "../medecin_partials/end.php"; ?>