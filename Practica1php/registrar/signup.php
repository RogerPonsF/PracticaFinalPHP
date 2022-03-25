<?php
    require('../db/bdUsuaris.php');
    $error=false;

    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        if($_POST["password"]==$_POST["password2"]){
            $infousuari = array(
                $unom=filter_input(INPUT_POST,'username'),
                $email=filter_input(INPUT_POST,'email'),
                $fnom=filter_input(INPUT_POST,'firstname'),
                $lnom=filter_input(INPUT_POST,'lastname'),
                $clau=filter_input(INPUT_POST,'password')
            );
            $error=registrar($infousuari);
            if($error==false){
                header("Location: ../index.php");
            }
        }
        else{$error=true;}
    }
?>
<!DOCTYPE html> 
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="../css/registrar.css"
            rel="stylesheet" type="text/css">
        <!------ Include the above in your HEAD tag ---------->
    </head>
    <body>
        <div id="signup">
            <div class="container">
                <div id="signup-row" class="row justify-content-center align-items-center">
                    <div id="signup-column" class="col-md-6">
                        <div id="signup-box" class="col-md-12">
                            <form id="signup-form" class="form" action="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <h5 class="text-center text-info">Sign Up CINETICS</h5>
                                <?php
                                    if($error == TRUE){
                                        echo '<p class="error">Credencials ja registrades o la contrasenya no coincideix</p>';
                                   }
                                ?>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control"required>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="text-info">First Name:</label><br>
                                    <input type="text" name="firstname" id="firstname" class="form-control"required>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="text-info">Last Name:</label><br>
                                    <input type="text" name="lastname" id="Lastname" class="form-control"required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control"required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Confirm Password:</label><br>
                                    <input type="password" name="password2" id="confirmpassword" class="form-control"required>
                                </div>
                                <div class="form-group">
                                <a href="../index.php" class="text-info">Have account? Login</a><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="REGISTER">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>