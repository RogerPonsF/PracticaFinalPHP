<?php
    session_start();
    include('../db/connectar-db.php');
        $comn='SELECT * FROM video ORDER BY datasubida DESC LIMIT 1';
        $cn = $db->prepare($comn);
        $cn->execute(array()); 
        foreach ($cn as $fila) {
            $id=$fila['idvideo'];
            $desc=$fila['descripcio'];
            $titolV=$fila['titol'];
            $likesV=$fila['likes'];
            $dislikesV=$fila['dislikes'];
            $puntV=$fila['puntuacio'];
        };
        $comn='SELECT NomHashtag  FROM relaciovh WHERE IDVideo = :nom';
        $cn = $db->prepare($comn);
        $cn->execute(array(':nom' => $id));
        foreach ($cn as $fila) {
            $hash=$fila['NomHashtag'];
        };
        $primervideo = array(
            $idv=$id,
            $descripcio=$desc,
            $titol=$titolV,
            $hastag=$hash,
            $likes=$likesV,
            $dislikes=$dislikesV,
            $puntuacio=$puntV
        );


        if(isset($_POST['like'])) {
            $id=array();
            $comn='SELECT idvideo FROM video';
            $cn = $db->prepare($comn);
            $cn->execute(array()); 
            $i=0;
            foreach ($cn as $fila) {
                $id[$i]=$fila['idvideo'];
                $i=$i+1;
            };
            $maxRandom = count($id) - 1;
            usleep(100);
            $randomVideoNum = rand(0, $maxRandom);
            $comn='SELECT * FROM video WHERE idvideo=:nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $id[$randomVideoNum])); 
            $i=0;
            foreach ($cn as $fila) {
                $id[$i]=$fila['idvideo'];
                $i=$i+1;
                $primervideo[0]=$fila['idvideo'];
                $primervideo[1]=$fila['descripcio'];
                $primervideo[2]=$fila['titol'];
                $likes=$fila['likes'];
                $dislikes=$fila['dislikes'];
                $puntuacio=$fila['puntuacio'];
            };
            $comn='SELECT NomHashtag  FROM relaciovh WHERE IDVideo = :nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $id[$randomVideoNum]));
            foreach ($cn as $fila) {
                $primervideo[3]=$fila['NomHashtag'];
            };
            actualizemlikes($primervideo,$likes,$dislikes,$puntuacio);
        }

        if(isset($_POST['dislike'])) {
            $id=array();
            $comn='SELECT idvideo FROM video';
            $cn = $db->prepare($comn);
            $cn->execute(array()); 
            $i=0;
            foreach ($cn as $fila) {
                $id[$i]=$fila['idvideo'];
                $i=$i+1;
            };
            $maxRandom = count($id) - 1;
            usleep(100);
            $randomVideoNum = rand(0, $maxRandom);
            $comn='SELECT * FROM video WHERE idvideo=:nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $id[$randomVideoNum])); 
            $i=0;
            foreach ($cn as $fila) {
                $id[$i]=$fila['idvideo'];
                $i=$i+1;
                $primervideo[0]=$fila['idvideo'];
                $primervideo[1]=$fila['descripcio'];
                $primervideo[2]=$fila['titol'];
                $likes=$fila['likes'];
                $dislikes=$fila['dislikes'];
                $puntuacio=$fila['puntuacio'];
            };
            $comn='SELECT NomHashtag  FROM relaciovh WHERE IDVideo = :nom';
            $cn = $db->prepare($comn);
            $cn->execute(array(':nom' => $id[$randomVideoNum]));
            foreach ($cn as $fila) {
                $primervideo[3]=$fila['NomHashtag'];
            };
            actualizemdislikes($primervideo,$likes,$dislikes,$puntuacio);
        }
        function actualizemlikes($primervideo,$likes,$dislikes,$puntuacio)
        {
            include('../db/connectar-db.php');
            $likes=$likes+1;
            $total=$likes + $dislikes;
            $puntuaciofinal= ($likes / $total) * 100;
            $sql = "UPDATE `video` SET likes = '$likes', puntuacio=' $puntuaciofinal' WHERE idvideo= '$primervideo[0]'";
            $update = $db->query($sql);
            $primervideo[4]=$likes;
            $primervideo[6]=$puntuaciofinal;

        }
        function actualizemdislikes($primervideo,$likes,$dislikes,$puntuacio)
        {
            include('../db/connectar-db.php');
            $dislikes=$dislikes+1;
            $total=$likes + $dislikes;
            $puntuaciofinal= ($likes / $total) * 100;
            $sql = "UPDATE `video` SET dislikes = '$dislikes', puntuacio='$puntuaciofinal' WHERE idvideo= '$primervideo[0]'";
            $update = $db->query($sql);
            $primervideo[5]=$dislikes;
            $primervideo[6]=$puntuaciofinal;

        }

?>

<!DOCTYPE html>
<html>
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
                    <a href="./pujarvideo.php" class="tornar"><b>Pujar Fitxer</b></a>
                    <a href="./perfil.php" class="tornar"><b>Perfil</b></a>
                    <a href="../index.php" class="tornar"><b>LOGOUT</b></a>
                </div>
            </div>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-12">
                        <div id="login-box" class="col-md-12">
                        <h3 class="videos"><?php echo $primervideo[2]?></h3>
                            <video class="video"  controls>
                                    <source src="../vid/<?php echo $primervideo[0]?>" type="video/mp4">
                            </video>
                            <form method="post">
                                <div id="demoA" class="row justify-content-center align-items-center">
                                    <button type="submit" name="like" id="buto1" class="fa fa-thumbs-up"></button>
                                    <p class="clasificacion">
                                        <div id="promig" name="l"class="row justify-content-center align-items-center">
                                            <p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $primervideo[6]?>% <br>DE LIKES</p>
                                        </div>
                                    </p>
                                    <button type="submit" name="dislike" id="buto2" class="fa fa-thumbs-down"></button>                                </form>
                                </div> 
                            <div style="overflow: hidden;">
                                        <p style="float: left;">&nbsp;<?php echo $primervideo[4]?><br>LIKES</p>
                                        <p style="float: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $primervideo[5]?><br>DISLIKES</p>
                            </div>
                            <div id="descripcio" name="d"class="row justify-content-center align-items-center">
                                <p><?php echo $primervideo[1] ?></p>
                            </div> 
                            <div id="hastags" name="h" class="row justify-content-center align-items-center">
                                <p><?php echo $primervideo[3] ?></p>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>