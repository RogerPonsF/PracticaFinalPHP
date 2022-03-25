<?php
    include("../db/connectar-db.php");

    $codi=$_GET["code"];
    $mail=$_GET["mail"];

    $user='SELECT * FROM user WHERE mail=:mail';
    $cn = $db->prepare($user);
    $cn->execute(array(':mail'=>$mail));
    
    foreach ($cn as $fila) {
        $resultat=$fila['activationCode'];
    }

    if(strcmp($codi,$resultat)==0){
        $sql = "UPDATE `user` SET activate='1', activationDate = now() WHERE mail = '$mail'";
        $update = $db->query($sql);
    }
    
    header('Location: ../index.php');
    exit;
?>