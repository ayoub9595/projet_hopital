<?php
ob_start();
require_once"../connection.php";
require "../patient_partials/begin.php";
$req = $conn->prepare("select * from specialite");
$req->execute();
$specs = $req->fetchAll();


?>


     <div class="row">
         <h1>Rendez vous pour une hosptilasation classique</h1>
        <div class="col-md-4 offset-3">

                <form method="post" action="">
              a  <div class="form-group">
                    <label for="date_debut">Date début:</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" >
                </div>
                <div class="form-group">
                    <label for="date_fin">Date fin:</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" >
                </div>
                <div class="form-group">
                    <label for="specialite">Service:</label>
                    <select class="form-control" name="specialite" id="specialite">
                     <?php foreach($specs as $s){?>
                        <option><?=$s["specialite"]?></option>
                     <?php }?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="postuler">Postuler</button>
            </form>
        </div>
    </div>

<?php
if(isset($_POST["postuler"])){
    $req=$conn->prepare("select idS from specialite where specialite = ?");
    $req->execute(array($_POST["specialite"]));
    $spec= $req->fetchAll();
    $spec_id= $spec[0]["idS"];
    $req=$conn->prepare("insert into admission (typeAd,DateDebut,DateFin,etat,idP,idS) values ('classique',?,?,'En cours',?,?)");
    $req->execute(array($_POST["date_debut"],$_POST["date_fin"],$_SESSION["id"],$spec_id));
    header("location:adm_hosp_class");
    ob_end_flush();
}

require "../patient_partials/end.php"; ?>