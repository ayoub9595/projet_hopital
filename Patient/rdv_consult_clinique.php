<?php
ob_start();
require_once"../connection.php";
require "../patient_partials/begin.php";
$req = $conn->prepare("select * from specialite");
$req->execute();
$specs = $req->fetchAll();


?>


    <div class="row">
        <h1>Rendez vous pour une consultation à la clinique</h1>
        <div class="col-md-4 offset-3">

            <form method="post" action="">
                 <div class="form-group">
                    <label for="date_r">Date du rendez vous</label>
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
    $req=$conn->prepare("insert into rv (dateR,heureR,etat,idP,idS) values (?,?,'En cours',?,?)");
    $req->execute(array($_POST["date_r"],$_POST["heure_r"],$_SESSION["id"],$spec_id));
    header("location:adm_consult_clinique.php");
    ob_end_flush();
}

require "../patient_partials/end.php"; ?>