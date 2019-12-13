<?php
ob_start();
require_once"../connection.php";
require "../patient_partials/begin.php";
$req = $conn->prepare("select admission.idAd,admission.DateDebut,specialite.specialite,admission.etat from admission inner join specialite on admission.idS=specialite.idS where idP= ? and Vu=0 and Archive=0 and typeAd='jour' ");
$req->execute(array($_SESSION["id"]));
$admissions= $req->fetchAll();


?>
<div class="row">
    <?php if (count($admissions)==0) { ?>
    <h1>Vous n'avez pas d'admissions</h1>
    <?php } else { ?>
    <h1>Liste des admissions aux hospitalisations du jour</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Date d'hospitalisation</th>
            <th scope="col">Service</th>
            <th scope="col">Etat</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($admissions as $admission) {?>
            <tr>
                <?php $idAd=$admission["idAd"] ?>
                <td><?=$admission["DateDebut"]?></td>
                <td><?=$admission["specialite"]?></td>
                <?php if($admission["etat"]=="En cours")
                    $color ="orange";
                else if($admission["etat"]=="Accepté")
                    $color="green";
                else $color ="red";
                ?>
                <td><strong style="color:<?=$color?>"><?=$admission["etat"]?></strong></td>


                <td><a class="btn btn-danger" href="supprimerAdmission.php?idAd=<?=$idAd?>">Supprimer</a>
                    <?php if ($admission["etat"]!="En cours"){ ?>
                    <a class="btn btn-success" href="marquerLuAdmission.php?idAd=<?=$idAd?>" style="padding-left: 3%">Marquer comme vu</a></td>
            <?php } ?>
            </tr>
        <?php }?>

        </tbody>
    </table>
    <?php }?>
</div>


<?php require "../patient_partials/end.php"; ?>
