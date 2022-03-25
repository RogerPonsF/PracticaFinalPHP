<?php
    function verificaUsuari($nom, $clau){
        try{
            include('connectar-db.php');

            $comn='SELECT * FROM user WHERE username=:nom OR mail=:nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $nom)); 
            $error=true;  
            foreach ($cn as $fila) {
                $resn=$fila['username'];
                $resm=$fila['mail'];
                $resnum=$fila['activate'];
                if($resnum==1)
                {
                    if($resn==$nom OR $resm==$nom){
                        $pass=$fila['passHash'];  
                        if(password_verify($clau,$pass))$error=false;
                        else $error=true;                    
                    }
                }
            }
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return $error;
    }



    function registrar($infousuari)
    {
        try{
            include('connectar-db.php');
            include('../mail/correu.php');
            $cp=false;
            $db->beginTransaction();
            $comn='SELECT * FROM user WHERE username=:nom OR mail=:nom2';   
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $infousuari[0],':nom2' => $infousuari[1])); 
            $error=false;  

            if(($cn->rowCount())>0)$error=true;
            if($error==false)
            {            
                $activacioc=hash('sha256',random_int(0,10000));
                $clauhash=password_hash($infousuari[4],PASSWORD_DEFAULT);
                $sql = "INSERT INTO user(mail,username,passHash,userFirstName,userLastName,activationCode) 
                   VALUES(:mail,:username,:passHash,:userFirstName,:userLastName,:activationCode)";
                $insert = $db->prepare($sql);
                $insert -> execute(array(':mail'=>$infousuari[1],':username'=>$infousuari[0],'passHash'=>$clauhash,':userFirstName'=>$infousuari[2],':userLastName'=>$infousuari[3],':activationCode'=>$activacioc));
                $db->commit();
                enviarmail($infousuari[1],$infousuari[0],$activacioc,$cp);
            }
            else $db->rollback();
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return $error;
    }

    function updatesessio($nom) 
    {
        include('connectar-db.php');
        $sql = "UPDATE `user` SET lastSingIn = now() WHERE username = '$nom'";
        $update = $db->query($sql);
    }

    function canvicontraseña($correu)
    {
        try{
            include('connectar-db.php');
            include('mail/correu.php');
            $cp=true;
            $mail=$correu;
            $comn='SELECT * FROM user WHERE mail=:nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $mail)); 
            $error=true;  
            foreach ($cn as $fila) {
                $resm=$fila['mail'];
                $codi=$fila['activationCode'];
                $resn=$fila['username'];
                if($resm==$mail)
                {
                    enviarmail($resm,$resn,$codi,$cp);
                }
               else echo 'Error amb la BDs: ' . $e->getMessage();
            }
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        return $error;
    }
?>