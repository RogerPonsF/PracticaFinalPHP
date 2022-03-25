<?php

$error1=false;
$error2=false;
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $codi=$_POST["code"];
        $mail=$_POST["mail"];

        $pass=$_POST["txtPassword"];
        $pass1=$_POST["txtPassword1"];  
        comprovar($pass,$pass1,$mail);
    }

    function comprovar($pass,$pass1,$mail)
    {
        include('../db/connectar-db.php');

        $comn='SELECT * FROM user WHERE mail=:nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $mail)); 
            $error=true;  
            foreach ($cn as $fila) {
                $passwrd=$fila['passHash'];
                if(password_verify($passwrd,$pass))
                    $error1=true; 
                else   
                
                    if($pass == $pass1)
                    {
                        $passh=password_hash($pass,PASSWORD_DEFAULT);
                        $sql = "UPDATE `user` SET passhash ='$passh' WHERE mail = '$mail'";
                        $update = $db->query($sql); 
                        header("Location: ../index.php");
                    }
                    else $error2=true;
            }
    }

?>
<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="../css/fpass.css" rel="stylesheet" type="text/css">
<script src="../java.js"></script>
<body>
    <div id="login">
        <h3 class="cinetics">CINETICS</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <h1 class="text-center text-info">NOVA CONTRASEÑA</h1>
                            <?php
                                if($error1 == true){
                                    echo '<p class="error">La contrasenya nova es igual que la entiga</p>';
                                }
                                if($error2 == true){
                                    echo '<p class="error">Les contrasenyes no coincideixen</p>';
                                }
                            ?>        
                            <label for="password" class="text-info">Escriu la nova contraseña:</label>
                            <div class="input-group">
                                <input ID="txtPassword" name="txtPassword" type="Password" Class="form-control">
                            </div>
                            <label for="password" class="text-info">Torna a escriure la nova contraseña:</label>
                            <div class="input-group">
                                <input ID="txtPassword1" name="txtPassword1" type="Password" Class="form-control">
                                <input ID="code" name="code" type="hidden" Class="form-control"value="<?php echo $_GET["code"]; ?>">
                                <input ID="mail" name="mail" type="hidden" Class="form-control"value="<?php echo $_GET["mail"]; ?>">
                            </div>
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="CONFIRMAR CONTRASENYA">
                            <a href="../index.php" class="tornar"><b>You have an account? LOGIN</b></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>