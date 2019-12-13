<?php
ob_start();
require_once"../connection.php";
require "../medecin_partials/begin.php";
$req2 = $conn->prepare("select * from utilisateur where fonction = 'patient' ");
$req2->execute();
$patients = $req2->fetchAll();
?>
<div class="row">
    <h1>Ajouter une ordonnance medicale</h1>
    <div class="col-md-4 offset-3">

        <form method="post" action="">
            <div class="form-group">
                <label for="specialite">Patient:</label>
                <select class="form-control" name="user" id="user">
                    <?php foreach($patients as $p){?>

                        <option><?=$p['nom']." ".$p['prenom']?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label for="medicament">Medicament à prescrire:</label>
                <textarea rows="5" cols="40" name="medicament" id="medicament"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="postuler">Ajouter</button>
        </form>
    </div>
</div>
<?php if(isset($_POST["postuler"])){
    $now = date_create('now')->format('d-m-Y');
    $nom_complet=preg_split('/[ ]/',$_POST["user"]);
    $req = $conn->prepare("select idU from utilisateur where nom=? and prenom=?");
    $req->execute(array($nom_complet[0],$nom_complet[1]));
    $idPatient = $req->fetchAll();
    $idP = $idPatient[0]["idU"];
    $req2 = $conn->prepare("insert into prescription values (NULL,?,?,?,?,?,0) ");
    $req2->execute(array($now,'medicament',$_POST["medicament"],$_SESSION["id"],$idP));
    header("location:index.php");
    ob_end_flush();
} ?>
<?php require "../medecin_partials/end.php";?>
