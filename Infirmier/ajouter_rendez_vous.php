<?php
ob_start();
require_once"../connection.php";
require "../infirmier_partials/begin.php";
$req = $conn->prepare("select * from specialite");
$req->execute();
$specs = $req->fetchAll();

$req2 = $conn->prepare("select * from utilisateur where fonction = 'patient' ");
$req2->execute();
$patients = $req2->fetchAll();


?>


    <div class="row">
        <h1>Rendez vous pour une hosptilasation classique</h1>
        <div class="col-md-4 offset-3">

            <form method="post" action="">
                  <div class="form-group">
                    <label for="date_debut">Date du rendez vous</label>
                    <input type="date" class="form-control" id="date_r" name="date_r" >
                </div>
                <div class="form-group">
                    <label for="specialite">Heure du rendez vous</label>
                    <select class="form-control" name="heure_r" id="heure_r">
                        <option>08h-09h</option>
                        <option>09h-10h</option>
                        <option>10h-11h</option>
                        <option>11h-12h</option>
                        <option>12h-13h</option>
                        <option>14h-15h</option>
                        <option>15h-16h</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="specialite">Service:</label>
                    <select class="form-control" name="specialite" id="specialite">
                        <?php foreach($specs as $s){?>
                            <option><?=$s["specialite"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="specialite">Patient:</label>
                    <select class="form-control" name="user" id="user">
                        <?php foreach($patients as $p){?>

                            <option><?=$p['nom']." ".$p['prenom']?></option>
                        <?php }?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="postuler">Valider</button>
            </form>
        </div>
    </div>

<?php
if(isset($_POST["postuler"])){
    $nom_complet=preg_split('/[ ]/',$_POST["user"]);
    $req=$conn->prepare("select idS from specialite where specialite = ?");
    $req->execute(array($_POST["specialite"]));
    $spec= $req->fetchAll();
    $spec_id= $spec[0]["idS"];
    $req2= $conn->prepare("select idU from utilisateur where nom= ? and prenom = ?");
    $req2->execute(array($nom_complet[0],$nom_complet[1]));
    $users= $req2->fetchAll();
    $user_id=$users[0]["idU"];
    $req=$conn->prepare("insert into rv (dateR,heureR,etat,idS,idP) values (?,?,'Accepté',?,?)");
    $req->execute(array($_POST["date_r"],$_POST["heure_r"],$spec_id,$user_id));
    header("location:liste_rendez_vous.php");

    ob_end_flush();

}

require "../infirmier_partials/end.php"; ?>