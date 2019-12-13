<?php
ob_start();
require_once "../connection.php";
require "../infirmier_partials/begin.php";
$req = $conn->prepare("select depense.idDep,depense.date_dep,depense.nom_dep,depense.prix_dep,utilisateur.nom,utilisateur.prenom 
 from depense inner join utilisateur on depense.idP=utilisateur.idU where depense.paye=0 ");
$req->execute();
$results = $req->fetchAll();
?>
<?php if(count($results)==0) {?>
    <h1>Il n'y a pas de dépense pour le moment</h1>
<?php } else { ?>
    <h1>Liste des prescriptions medicales</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Patient</th>
            <th scope="col">Date</th>
            <th scope="col">Type de dépense</th>
            <th scope="col">Prix</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result) { ?>
            <tr>
                <td><?=$result["nom"]." ".$result["prenom"]?></td>
                <td><?=$result["date_dep"]?></td>
                <td><?=$result["nom_dep"]?></td>
                <td><?=$result["prix_dep"] ?></td>
                <td>
                           <a class="btn btn-info" href="modifier_depense.php?idDep=<?=$result["idDep"] ?>">Modifier</a>
                           <a class="btn btn-danger" href="#">Supprimer</a>
                 </td>

            </tr>
        <?php }?>

        </tbody>
    </table>
<?php } ?>
<?php require "../infirmier_partials/end.php"; ?>
