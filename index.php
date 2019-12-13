<?php
session_start();
if (isset($_SESSION["connected"])){
    header("location:Patient");
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Centre Hospitalier</title>
	<link rel="stylesheet" href="css/style.css"></link>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
</head>
<body >
  <div class="img-background">
    <div class="row" style="padding: 5%">
      <div class="col-md-4 offset-4">
        <div class="card">
          <div class="card-header">
            Autentification
          </div>
          <div class="card-body">
            <form method="POST" action="login.php" >
              <div class="form-group">
                <label for="exampleInputEmail1">Login:</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre login">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
              </div>
              <div class="form-group">
                <small>Vous n'avez de compte ? Inscrivez vous <a href="inscription.php">ici</a></small>
              </div>
              <button type="submit" class="btn btn-primary">Connexion</button>
            </form>     
          </div>
        </div>
      </div>
    </div>
  </div>


</body>
</html>






		
