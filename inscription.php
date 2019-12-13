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
<div class="img-background2">
    <div class="row" style="padding: 5%">
    <div class="col-md-4 offset-4">
         <div class="card">
         <div class="card-header">
          Inscription
         </div>
  <div class="card-body">
    <form method="POST" onsubmit="event.preventDefault();signin()" >
       <div class="form-group">
    <label for="exampleInputEmail1">Nom:</label>
    <input type="text" class="form-control" id="nom">
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
    <label for="exampleInputPassword1">Confirmer le mot de passe:</label>
    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
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
    <small>Vous avez deja un compte ? Connectez vous <a href="index.php">ici</a></small>
  </div>
  <button type="submit" class="btn btn-primary">S'inscrire</button>
  
    </form> 
  
  </div>
    </div>
</div>

<script>
    function signin(){
        var resp
        var http = new XMLHttpRequest()
        var url = "inscrire.php";
        var nom = document.getElementById("nom").value
        var prenom = document.getElementById("prenom").value
        var date_naissance = document.getElementById("date_naissance").value
        var login = document.getElementById("login").value
        var password = document.getElementById("password").value
        var confirm_password = document.getElementById("confirm_password").value
        var cin = document.getElementById("cin").value
        var telephone = document.getElementById("telephone").value

        var pat1 = /^[A-Za-z]+$/
        var pat2 = /^O\d{9}$/s

        if(!pat1.test(nom) || !pat1.test(prenom))
            alert("Veuillez donner des noms valides")
        else if (password.length<6)
            alert("La taille minimale d'un mot de passe est de 6 caracteres")
        else if (password!=confirm_password)
            alert("Les deux mot de passes ne sont pas identiques")

        else{


        var params = "nom="+nom+"&prenom="+prenom+"&date_naissance="+date_naissance+"&login="+login+"&password="+password+"&cin="+cin+"&telephone="+telephone
        http.open('POST', url, false)
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 200) {
        resp=http.responseText
    }
          }
     http.send(params);

           if(resp == "failure")
               alert("Ce login existe déja")
           else {
               var res = JSON.parse(resp)
               var id = res.id
               var login1 =res.login
               var pass = res.mdp
               document.cookie ="id = "+id
               document.cookie ="password = "+password
               document.cookie = "login = "+login
               window.location.href= "home.php"
           }
        }

}


</script>

</body>
</html>




