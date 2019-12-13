<?php
ob_start();
require "../connection.php";
require "../infirmier_partials/begin.php"; ?>

<div class="row">
    <h1>Modifier une dépense</h1>
</div>
<div class="row" style="padding-top: 50px">
<div class="col-md-4 offset-4">
    <form method="post" action="">

        <div class="form-group">
            <label for="paye">Etat</label>
            <select class="form-control" id="paye" name="paye">
                <option>Non payée</option>
                <option>Payée</option>
            </select>
        </div>
        <button class="btn btn-primary" name="modifier">Modifier</button>

    </form>
</div>
</div>

<?php
  if(isset($_POST["modifier"])){
      $paye = "0";
      if ($_POST["paye"]=="Payée")
          $paye="1";
      $req= $conn->prepare("update depense set paye =? where idDep= ?");
      $req->execute(array($paye,$_GET["idDep"]));
      header("location:liste_depense.php");
      ob_end_flush();
  }


?>




<?php require "../infirmier_partials/end.php"; ?>
