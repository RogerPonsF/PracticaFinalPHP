<?php
    session_start();
    include('../db/connectar-db.php');
    $user= $_SESSION['usuari'];
        $comn='SELECT * FROM user WHERE username=:nom';
        $cn = $db->prepare($comn);
        $cn->execute(array(':nom' => $user)); 
        foreach ($cn as $fila) {
            $mailU=$fila['mail'];
            $fname=$fila['userFirstName'];
            $lname=$fila['userLastName'];
            $usernameU=$fila['username'];
            $id=$fila['iduser'];
        };

        $comn='SELECT * FROM video WHERE userid=:nom';
        $cn = $db->prepare($comn);
        $cn->execute(array(':nom' => $id)); 
        $puntuaciomesalta=0;
        foreach ($cn as $fila) {
            $puntuaciofinal=$fila['puntuacio'];
            $idvideo = $fila['idvideo'];
            $titol = $fila['titol'];

            if($puntuaciomesalta<$puntuaciofinal)
            {
                $puntuaciomesalta=$puntuaciofinal;
                $idpuntaciomesalta=$idvideo;
                $titolfinal=$titol;
            }
        };
        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {
            if($_POST["correu"])
            {
                $mail=$_POST["correu"];
                canvimail($mail,$user);
            }
        }
    function canvimail($mail,$user)
    {
        session_start();
        include('../db/connectar-db.php');
        $comn='SELECT * FROM user WHERE username=:nom';
        $cn = $db->prepare($comn);
        $cn->execute(array(':nom' => $user)); 
        foreach ($cn as $fila) {
            $mailU=$fila['mail'];
        };

        $comn='SELECT mail FROM user';
        $cn = $db->prepare($comn);
        $cn->execute(array()); 
        foreach ($cn as $fila) {
            $mailA=$fila['mail'];
            if($mailA==$mail)
            {
                $error=true;
            }
        };

        if($error==false)
        {
            $sql = "UPDATE `users` SET mail = '$mail' WHERE mail= '$mailU'";
            $update = $db->query($sql);
        }
        
    }

?>

<!DOCTYPE html>
<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../java.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <body>
        <div id="login">
            <h3 class="cinetics">CINETICS</h3>
            <div class="dropdown">
                <button onclick="dropdown()" class="dropbtn" >Opcions</button>
                <div id="myDropdown" class="dropdown-content" >
                    <a href="../upload.php" class="tornar"><b>Pujar Fitxer</b></a>
                    <a href="../home/main.php" class="tornar"><b>Home</b></a>
                    <a href="../index.php" class="tornar"><b>LOGOUT</b></a>
                </div>
            </div>
            <h3 class="perfil">PERFIL</h3><br>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-12">
                        <div id="login-box" class="col-md-12">
                            <div id="Nom">
                                <form id="login-form" class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <p><b>Nom: </b><?php echo $fname ?></p>
                                    <p><b>Cognoms: </b><?php echo $lname ?></p>
                                    <p><b>Usuari: </b><?php echo $usernameU ?></p>
                                    <p><b>Correu: </b><?php echo $mailU?>&nbsp;&nbsp;<button  class="fa fa-edit" data-toggle="modal" data-target="#exampleModalCenter" href="#myModal"></button>
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title" id="exampleModalLongTitle">EDITAR CORREU</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="txt" class="text-info">Cambiar Correu :</label><br>
                                            <input type="text" name="correu" id="correu" class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-info btn-md" value="Canviar">                                  </div>
                                        </div>
                                    </div>
                                </form>
                            </div></p>
                            <h3 class="videos">ELS TEU VIDEO AMB MÉS LIKES</h3><br>
                            <video  class="video" controls>
                                    <source src="../vid/<?php echo $idpuntaciomesalta ?>" type="video/mp4">
                            </video>
                            <!--<p class="info">Titol: <?php echo $titolfinal ?></p><br> -->
                            <p class="info">Puntuacio: <?php echo $puntuaciomesalta?></p><br>
                          </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>