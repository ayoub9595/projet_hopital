<?php
$idR = $_GET["idR"];
ob_start();
require_once"../connection.php";
require "../infirmier_partials/begin.php";

?>


    <div class="row">
        <h1>Modifier une admission pour une consultation à la clinique</h1>
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

    $req=$conn->prepare("update rv set etat = ? where idRV =?");
    $req->execute(array($_POST["etat"],$idR));
    header("location:liste_rendez_vous.php");
    ob_end_flush();
}

require "../infirmier_partials/end.php"; ?>