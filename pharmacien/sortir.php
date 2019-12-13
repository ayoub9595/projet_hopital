<?php
ob_start();
require_once"../connection.php";
require "../pharmacien_partials/begin.php";
$req = $conn->prepare("select * from medicament");
$req->execute();
$medicaments = $req->fetchAll();


?>
 <div class="row">
        <h1>Faire sortir un médicament</h1>
</div>
    <div class="row">

        <div class="col-md-4 offset-3">

            <form method="post" action="">
                  <div class="form-group">
                    <label for="medicament">Médicament</label>
                    <select class="form-control" name="medicament" id="medicament">
                        <?php foreach($medicaments as $s){?>
                            <option><?=$s["nom"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="text" class="form-control" name="quantite" id="quantite">
                </div>
                <button type="submit" class="btn btn-primary" name="ajouter">Valider</button>
            </form>
        </div>
    </div>


<?php
if(isset($_POST["ajouter"])){
    $req=$conn->prepare("select numStock from medicament where nom = ?");
    $req->execute(array($_POST["medicament"]));
    $num= $req->fetchAll();
    $num_id= $num[0]["numStock"];
    $req1=$conn->prepare("select quantite from stock where numStock = '$num_id' ");
    $req1->execute();
    $quantite= $req1->fetchAll();
    $quantite_id= $quantite[0]["quantite"];

    if($quantite_id < $_POST["quantite"]){
        echo"<div style=\"color:red;\">"."quantite n'est pas disponible !!"."</div>";
    }
    else {
    $nvQ = $quantite_id - $_POST["quantite"];
    $req2= $conn->prepare("update stock SET quantite= ? WHERE numStock= ? ");
    $req2->execute(array($nvQ ,$num_id));

    header("location:liste_stock.php");
}
    ob_end_flush();

}

require "../pharmacien_partials/end.php"; ?>