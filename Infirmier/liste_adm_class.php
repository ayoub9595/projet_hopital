<?php
ob_start();
require_once"../connection.php";
require "../infirmier_partials/begin.php";
$req = $conn->prepare("select admission.idAd,admission.DateDebut,admission.DateFin,specialite.specialite,admission.etat,utilisateur.nom,utilisateur.prenom,utilisateur.cin
 from admission inner join specialite on admission.idS=specialite.idS inner join utilisateur on admission.idP=utilisateur.idU  where Vu=0 and Archive=0 and typeAd='classique' ");
$req->execute();
$admissions= $req->fetchAll();


?>
<div class="row">
    <?php if(count($admissions)==0) { ?>
        <h1>Vous n'avez pas d'admissions pour le moment</h1>
    <?php } else { ?>
        <h1>Liste des admissions aux hospitalisations classiques</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Patient</th>
                <th scope="col">Date Début</th>
                <th scope="col">Date Fin</th>
                <th scope="col">Service</th>
                <th scope="col">Etat</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($admissions as $admission) {?>
                <tr>
                    <?php $idAd=$admission["idAd"] ?>
                    <td><?=$admission["nom"]." ".$admission["prenom"]?></td>
                    <td><?=$admission["DateDebut"]?></td>
                    <td><?=$admission["DateFin"]?></td>
                    <td><?=$admission["specialite"]?></td>
                    <?php if($admission["etat"]=="En cours")
                        $color ="orange";
                    else if($admission["etat"]=="Accepté")
                        $color="green";
                    else $color ="red";
                    ?>
                    <td><strong style="color:<?=$color?>"><?=$admission["etat"]?></strong></td>


                    <td><a class="btn btn-info" href="modifier_adm_class.php?idAd=<?=$idAd?>" style="padding-left: 3%">Modifier</a>
                        <a class="btn btn-danger" href="supprimer_adm_class.php?idAd=<?=$idAd?>">Supprimer</a></td>

                </tr>
            <?php }?>

            </tbody>
        </table>
    <?php } ?>
</div>


<?php require "../infirmier_partials/end.php"; ?>
