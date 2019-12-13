<?php
ob_start();
require_once"../connection.php";
require "../pharmacien_partials/begin.php";


?>


    <div class="row">
        <h1>Ajouter un médicament au stock</h1>
        <div class="col-md-4 offset-3">

            <form method="post" action="">
                  <div class="form-group">
                    <label for="medicament">Médicament</label>
                    <input type="text" class="form-control" id="medicament" name="medicament" >
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité</label>
                    <input type="text" class="form-control" name="quantite" id="quantite">
                     
                </div>
                <div class="form-group">
                    <label for="date_p">Date de péremption</label>
                    <input type="Date" class="form-control" name="date_p" id="date_p">
                     
                </div>
                <div class="form-group">
                    <label for="date_p">Quantité min</label>
                    <input type="text" class="form-control" name="quantitem" id="quantitem">
                     
                </div>
                <button type="submit" class="btn btn-primary" name="ajouter">Valider</button>
            </form>
        </div>
    </div>

<?php
if(isset($_POST["ajouter"])){

    $req=$conn->prepare("insert into stock (quantite,quantitem) values ('".$_POST["quantite"]."','".$_POST["quantitem"]."')");
    $req->execute();
    $sql = "select max(numStock) as numS FROM stock ";  
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $r=$row['numS'];
    $req3=$conn->prepare("insert into medicament (nom,dateP,numStock) values ('".$_POST["medicament"]."','".$_POST["date_p"]."','$r')");
    $req3->execute();
    header("location:liste_stock.php");

    ob_end_flush();

}

require "../pharmacien_partials/end.php"; ?>