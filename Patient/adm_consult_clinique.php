<?php
ob_start();
require_once"../connection.php";
require "../patient_partials/begin.php";
$req = $conn->prepare("select rv.idRV,rv.dateR,rv.heureR,specialite.specialite,rv.etat from rv inner join specialite on rv.idS=specialite.idS where idP= ? and Vu=0 and Archive=0 ");
$req->execute(array($_SESSION["id"]));
$admissions= $req->fetchAll();


?>
<div class="row">
    <?php if(count($admissions)== 0) { ?>
    <h1>Vous n'avez pas d'admissions pour le moment</h1>
    <?php } else { ?>
    <h1>Liste des admissions aux consultations de cliniques</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Date du rendez-vous</th>
            <th scope="col">Heure du rendez-vous</th>
            <th scope="col">Service</th>
            <th scope="col">Etat</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($admissions as $admission) {?>
            <tr>
                <?php $idR=$admission["idRV"] ?>
                <td><?=$admission["dateR"]?></td>
                <td><?=$admission["heureR"]?></td>
                <td><?=$admission["specialite"]?></td>
                <?php if($admission["etat"]=="En cours")
                    $color ="orange";
                else if($admission["etat"]=="Accepté")
                    $color="green";
                else $color ="red";
                ?>
                <td><strong style="color:<?=$color?>"><?=$admission["etat"]?></strong></td>


                <td><a class="btn btn-danger" href="supprimerRv.php?idR=<?=$idR?>">Supprimer</a>
                    <?php if ($admission["etat"]!="En cours"){ ?>
                    <a class="btn btn-success" href="marquerLuRv.php?idR=<?=$idR?>" style="padding-left: 3%">Marquer comme vu</a></td>
            <?php } ?>
            </tr>
        <?php }?>

        </tbody>
    </table>
    <?php } ?>
</div>


<?php require "../patient_partials/end.php"; ?>
