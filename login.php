<?php

    require_once("connection.php");
    $query = $conn->prepare("SELECT * from utilisateur where login=? and mdp=? limit 1");
    $query->execute( array($_POST['login'], md5($_POST['password'])) );
    $result = $query->fetchAll();



    if(count($result)>0) {
        session_start();
        $_SESSION['connected']=true;
        $_SESSION['nom']= $result[0]['nom'];
        $_SESSION['prenom']= $result[0]['prenom'];
        $_SESSION['id']= $result[0]['idU'];
        $_SESSION['login']= $result[0]['login'];
        $_SESSION['password']= $result[0]['password'];
        $_SESSION['fonction']=$result[0]['fonction'];

        if($_SESSION['fonction']=="patient"){
            header("location:Patient");
        }
        else if($_SESSION['fonction']=="infirmier"){
            header("location:Infirmier");
        }
        else if($_SESSION['fonction']=="medecin"){
            header("location:Medecin");
        }
        else if($_SESSION['fonction']=="admin"){
            header("location:Admin");
        }
        else if($_SESSION['fonction']=="pharmacien"){
            header("location:pharmacien");
        }

    }
    else {

           header("location:index.php");
    }

?>