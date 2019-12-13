<?php require "../admin_partials/begin.php"; ?>
<?php require_once "../connection.php";
$req=$conn->prepare("select * from utilisateur where fonction='pharmacien' ");
$req->execute();
$medecins = $req->fetchAll();
?>
<?php if(count($medecins)==0){?>
    <h1>Le centre ne contient pas de medecins pour le moment</h1>
<?php } else { ?>
    <h1>Liste des pharmaciens</h1>
    <table class="table">
        <thead>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Date de naissance</th>
        <th scope="col">CIN</th>
        <th scope="col">Actions</th>
        </thead>
        <?php foreach($medecins as $medecin){ ?>
            <tr>
                <td><?=$medecin["nom"]?></td>
                <td><?=$medecin["prenom"]?></td>
                <td><?=$medecin["date_naissance"]?></td>
                <td><?=$medecin["cin"]?></td>
                <td><a href="#" class="btn btn-info" ">Modifier</a>
                    <a href="#" class="btn btn-danger" style="padding-left: 3px">Supprimer</a></td>

            </tr>
        <?php } ?>
    </table>


<?php } ?>

<?php require "../admin_partials/end.php";?>
