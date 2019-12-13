<?php require "../admin_partials/begin.php";
require_once "../connection.php";
?>
<h1>Ajouter un pharmacien</h1>
<div class="row">
    <div class="col-md-4 offset-3">
        <form method="POST">
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
    $req = $conn->prepare("insert into utilisateur (nom,prenom,date_naissance,login,cin,tel,mdp,fonction) values
 (?,?,?,?,?,?,?,'pharmacien')");
    $req->execute(array($nom,$prenom,$date_naissance,$login,$cin,$telephone,md5($password)));
} ?>
<?php require "../admin_partials/end.php" ?>


