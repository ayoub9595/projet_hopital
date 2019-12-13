<?php require"../infirmier_partials/begin.php" ?>
<?php require_once "../connection.php";
$req2 = $conn->prepare("select * from utilisateur where fonction = 'patient' ");
$req2->execute();
$patients = $req2->fetchAll();
?>
<div class="row">
    <h1>Generer facture</h1>
</div>
<div class="row">
    <div class="col-md-4 offset-3" >
        <form method="post" action="imprimer_facture.php">
            <div class="form-group">
                <label for="specialite">Patient:</label>
                <select class="form-control" name="patient" id="pateint">
                    <?php foreach($patients as $p){?>

                        <option><?=$p['nom']." ".$p['prenom']?></option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="postuler">Valider</button>
        </form>
    </div>
</div>

<?php require "../infirmier_partials/end.php"?>
