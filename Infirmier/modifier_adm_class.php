<?php
$idAd = $_GET["idAd"];
ob_start();
require_once"../connection.php";
require "../infirmier_partials/begin.php";

?>


    <div class="row">
        <h1>Modifier une admission d'hospitatlisation classique</h1>
        <div class="col-md-4 offset-3">

            <form method="post" action="">

                <div class="form-group">
                    <label for="etat">Etat:</label>
                    <select class="form-control" name="etat" id="etat">
                        <option>En cours</option>
                        <option>Accepté</option>
                        <option>Refusé</option>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
            </form>
        </div>
    </div>

<?php
if(isset($_POST["modifier"])){

    $req=$conn->prepare("update admission set etat = ? where idAd =?");
    $req->execute(array($_POST["etat"],$idAd));
    header("location:liste_adm_class.php");
    ob_end_flush();
}

require "../infirmier_partials/end.php"; ?>