<?php require "../admin_partials/begin.php";
require_once "../connection.php";
$req = $conn->prepare("select * from specialite");
$req->execute();
$services = $req->fetchAll();

?>
<h1>Ajouter un medecin</h1>
<div class="row">
    <div class="col-md-4 offset-3">
        <form method="POST" action="">
            <div class="form-group">
                <label for="exampleInputEmail1">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Prenom:</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date de Naissance:</label>
                <input type="text" class="form-control" id="date_naissance" name="date_naissance" placeholder="jj/mm/aaaa">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Login:</label>
                <input type="text" class="form-control" id="login" name="login">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Telephone:</label>
                <input type="text" class="form-control" id="telephone" name="telephone">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">CIN:</label>
                <input type="text" class="form-control" id="cin" name="cin">
            </div>
            <div class="form-group">
                <label for="specialite">Service:</label>
                <select class="form-control" id="specialite" name="specialite">
                    <?php foreach($services as $service){ ?>
                    <option><?=$service["specialite"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>

        </form>
    </div>
</div>
<?php if(isset($_POST["ajouter"])){
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $date_naissance = $_POST["date_naissance"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $telephone = $_POST["telephone"];
    $cin = $_POST["cin"];
    $specialite = $_POST["specialite"];
    $req = $conn->prepare("insert into utilisateur (nom,prenom,date_naissance,login,cin,tel,mdp,fonction,specialite) values
 (?,?,?,?,?,?,?,'medecin',?)");
    $req->execute(array($nom,$prenom,$date_naissance,$login,$cin,$telephone,md5($password),$specialite));
    header("location:liste_medecin.php");
} ?>
<?php require "../admin_partials/end.php" ?>


