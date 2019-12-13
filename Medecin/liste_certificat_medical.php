<?php
ob_start();
require_once "../connection.php";
require "../medecin_partials/begin.php";
$req = $conn->prepare("select prescription.idPres,prescription.datePres,prescription.genre,prescription.corps,prescription.idP,
utilisateur.nom,utilisateur.prenom from prescription inner join utilisateur on prescription.idP = utilisateur.idU where genre='certificat' and Archive=0 ");
$req->execute();
$results = $req->fetchAll();
?>
<?php if(count($results)==0) {?>
    <h1>Vous n'avez pas de prescriptions pour le moment</h1>
<?php } else { ?>
    <h1>Liste des certificats medicaux</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Patient</th>
            <th scope="col">Date</th>
            <th scope="col">Durée</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result) { ?>
            <tr>
                <td><?=$result["nom"]." ".$result["prenom"]?></td>
                <td><?=$result["datePres"]?></td>
                <td><?=nl2br($result["corps"])?> jours</td>
                <td><a class="btn btn-warning" href="imprimer_certificat_medical.php?idPres=<?=$result['idPres']?>" style="padding-left: 3%"><i class="fa fa-print" style="padding-left: 7px"></i></a>
                    <a class="btn btn-info" href="#"><i class="fa fa-pencil-alt"></i></a>
                    <a class="btn btn-danger" href="supprimer_certificat_medical.php?id=<?=$result['idPres']?>"><i class="fa fa-trash"></i></a>
                </td>

            </tr>
        <?php }?>

        </tbody>
    </table>
<?php } ?>
<?php require "../medecin_partials/end.php"; ?>
@