<?php
    require('./db/bdUsuaris.php');
    $error=false;
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        if(!empty($_POST["username"]))
        {
            $nom=$_POST["username"];
            $clau=$_POST["contra"];
            $error=verificaUsuari($nom, $clau);
    
            if($error==false){
                session_start();
                updatesessio($nom);
                $_SESSION['usuari']=$nom;
                header("Location: ./home/main.php");
            }
        }
        if($_POST["correu"])
        {
            $mail=$_POST["correu"];
            canvicontraseña($mail);
        }
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="./css/login.css"
            rel="stylesheet" type="text/css">
            <script src="./java.js"></script>
        <!------ Include the above in your HEAD tag ---------->

    </head>
    <body>
        <div id="login">
            <h3 class="cinetics">CINETICS</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <h3 class="text-center text-info">Login</h3>
                                        <?php
                                            if($error == TRUE){
                                            echo '<p class="error">Revisa l'. "'". 'adreça de correu i/o la contrasenya</p>';
                                                }
                                        ?>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control"  placeholder="user/mail" aria-describedby="sizing-addon1" required>
                                </div>
                                <label for="password" class="text-info">Password:</label>
                                <div class="input-group">
                                    <input ID="txtPassword" name="contra" type="password" Class="form-control" aria-describedby="sizing-addon1" required>
                                        <div class="input-group-append">
                                            <button id="show_password" class="btn btn-primary" type="button"  onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <br><input type="submit" name="submit" class="btn btn-info btn-md" value="Sign In"><br>
                                    <div id="register-link" class="text-right">
                                        <br><a>Dont have an account?</a>
                                        <br><a href="./registrar/signup.php" class="text-info">Sign Up</a>
                                    </div>
                                </div>    
                            </form>
                            
                            <form id="login-form2" class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <a  class="text-info" data-toggle="modal" data-target="#exampleModalCenter" href="#myModal">Contrasenya Oblidada?</a>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">RECUPERACIÓ DE CONTRASENYA (NO DE PHP)</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="email" class="text-info">Escriu el teu correu per recuperar la contrasenya:</label><br>
                                                    <input type="text" name="correu" id="correu" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-info btn-md" value="Enviar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
</body>
    </body>
</html>