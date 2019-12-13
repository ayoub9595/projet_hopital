<?php
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$date_naissance = $_POST["date_naissance"];
$login = $_POST["login"];
$password = $_POST["password"];
$cin = $_POST["cin"];
$telephone = $_POST["telephone"];
require_once"connection.php";

$req=$conn->prepare("select * from utilisateur where login = ?" );
$req->execute(array($login));
$user = $req->fetchAll();
if(count($user)>0){
    echo "failure";
}
else{
    $req=$conn->prepare("insert into utilisateur (nom,prenom,date_naissance,login,mdp,cin,tel,fonction) values(?,?,?,?,?,?,?,'patient') " );
    $req->execute(array($nom,$prenom,$date_naissance,$login,md5($password),$cin,$telephone));
    $req=$conn->prepare("select * from utilisateur where login = ?");
    $req->execute(array($login));
    $user = $req->fetchAll();
    echo json_encode($user);
}


?>