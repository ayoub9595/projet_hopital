<?php
ob_start();

require_once"../connection.php";
require "../pharmacien_partials/begin.php";
$req = $conn->prepare("select stock.quantite,stock.quantitem,medicament.nom,medicament.dateP
 from stock inner join medicament on stock.numStock=medicament.numStock ");
$req->execute();
$medicaments= $req->fetchAll();

?>

<div class="row">
    <?php if(count($medicaments)== 0) { ?>
        <h1>Vous n'avez pas de stock</h1>
    <?php } else { ?>
        <h1>Liste de stock des médicaments</h1>
    
        <div style="display: inline-block;padding:35px; margin-left:95px">
     			<form method="POST" action="">
                <label style="font-size: 16pt;" padding="10px">Recherche</label> 
                <input type="text"  name="type" id="type" class="typeahead tt-query" autocomplete="off" spellcheck="fals" placeholder="médicament"> 
    
            <button type="submit" class="btn btn-primary" name="chercher">chercher</button>
            </form>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Médicament</th>
                <th scope="col">Quantité</th>
                <th scope="col">Date de péremption</th>
                <th scope="col">Quantité min</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach($medicaments as $medicament) {?>
                <tr>
                    <td><?=$medicament["nom"]?></td>
                    <td><?=$medicament["quantite"]?></td>
                    <td><?=$medicament["dateP"]?></td>
                    <td><?=$medicament["quantitem"]?></td>

                   

            <?php }?>

            </tbody>
        </table>
    <?php } ?>
</div>


<?php 
if(isset($_POST["chercher"])){


    header("location:listeR.php");
    ob_end_flush();
}




require "../pharmacien_partials/end.php"; ?>