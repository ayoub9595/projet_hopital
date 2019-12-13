<?php require "../medecin_partials/begin.php"?>
<?php require_once "../connection.php";
$req = $conn->prepare("select * from utilisateur where fonction='patient'");
$req->execute();
$results = $req->fetchAll();?>
<?php if(count($results)==0) {?>
    <h1>Vous n'avez pas de prescriptions pour le moment</h1>
<?php } else { ?>
    <h1>Liste des patients</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">CIN</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($results as $result) { ?>
            <tr>
                <td><?=$result["nom"]?></td>
                <td><?=$result["prenom"]?></td>
                <td><?=$result["date_naissance"]?></td>
                <td><?=$result["cin"]?></td>
                <td><a class="btn btn-warning" href="dossier_medical.php?id=<?=$result["idU"] ?>" style="padding-left: 3%">Acceder au dossier medical</a>
                </td>

            </tr>
        <?php }?>

        </tbody>
    </table>
<?php } ?>

<?php require "../medecin_partials/end.php"?>
