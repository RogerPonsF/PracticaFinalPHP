<?php

if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    session_start();

    $media=$_FILES["adjunto"]["size"];
    if($media<1024*1024*1024 && $media!=null){
        $rand=random_int(0,10000);
        $namesh=$_FILES["adjunto"]["name"] . $rand;
        $nomfinal=hash("sha256",$namesh);
        $vid= move_uploaded_file($_FILES["adjunto"]["tmp_name"], "../vid/"."$nomfinal");
    }
    else echo"error";
    if($vid)
    {
        $infovideo = array(
            $idVideo=$nomfinal,
            $user= $_SESSION['usuari'],
            $titol=filter_input(INPUT_POST,'txtTitol'),
            $descripcio=filter_input(INPUT_POST,'txtDesc'),
            $hastag=filter_input(INPUT_POST,'txtHash')
        );
        guardarVid($infovideo);
    }
}
function guardarVid($infovideo)
{
    include('../db/connectar-db.php');
    $comn='SELECT * FROM user WHERE username=:nom ';
    $cn = $db->prepare($comn);
    $cn->execute(array(':nom' => $infovideo[1])); 
    foreach ($cn as $fila) {
        $idu=$fila['iduser'];
        $username=$fila['username'];
        if($username==$infovideo[1])
        {
            $idusuarifinal=$idu;
        }
    };
    if($idusuarifinal != null)
    {
        $db->beginTransaction();
        $sql = "INSERT INTO video(idvideo, titol, descripcio,likes,dislikes,puntuacio,userid) 
                       VALUES(:idvideo,:titol,:descripcio,:likes,:dislikes,:puntuacio,:userid)";
        $insert = $db->prepare($sql);
        $insert -> execute(array(':idvideo'=>$infovideo[0],':titol'=>$infovideo[2],':descripcio'=>$infovideo[3],':dislikes'=>0,':likes'=>0,':puntuacio'=>0,':userid'=>$idusuarifinal));
        $db->commit();
        guardarHashtag($infovideo);
    }
    
}
function guardarHashtag($infovideo)
{
    include('../db/connectar-db.php');
    $comn='SELECT * FROM hashtag';
    $cn = $db->prepare($comn);
    $cn->execute(array()); 
    $repetit=false;
    foreach ($cn as $fila) {
        $nom=$fila['nom'];
        $copsrepetit=$fila['reconta'];
        if($nom==$infovideo[4])
        {
            $repetit= true;
            $cops=$copsrepetit;
        }
    };
    if ($repetit==true)
    {
        $cops=$cops+1;
        $db->beginTransaction();
        $sql = "UPDATE `hashtag` SET reconta ='$cops' WHERE nom = '$infovideo[4]'";
        $update = $db->query($sql); 
    }
    else  
     
        $db->beginTransaction();
        $sql = "INSERT INTO hashtag(nom, reconta) 
                    VALUES(:nom,:reconta)";
        $insert = $db->prepare($sql);
        $insert -> execute(array(':nom'=>$infovideo[4],':reconta'=>1));
        $db->commit();
        afegirrelacio($infovideo);   
}
function afegirrelacio($infovideo)
{
    include('../db/connectar-db.php');
    $db->beginTransaction();
    $sql = "INSERT INTO relaciovh(IDVideo , NomHashtag ) 
                VALUES(:nom,:hashtag)";
    $insert = $db->prepare($sql);
    $insert -> execute(array(':nom'=>$infovideo[0],':hashtag'=>$infovideo[4]));
    $db->commit();
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
<link href="../css/upload.css" rel="stylesheet" type="text/css">
<script src="../java.js"></script>
<body>
    <div id="login">
        <h3 class="cinetics">CINETICS</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <form name="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">                            <h1 class="text-center text-info">PUJAR FITXER</h1>        
                            <label name="titulo" class="text-info">Titol:</label>
                            <div class="input-group">
                                <input ID="txtTitol" name="txtTitol" type="text" Class="form-control">
                            </div>
                            <label name="descripcio" class="text-info">Descripció</label>
                            <div class="input-group">
                                <input ID="txtDesc" name="txtDesc" type="text" Class="form-control">
                            </div>
                            <label name="hashtag" class="text-info">Hashtags</label>
                            <div class="input-group">
                                <input ID="txtHash" name="txtHash" type="text" Class="form-control">
                            </div>
                            <br>
                            <!-- ¡No olvides el enctype! -->
                            <!-- Campo de selección de archivo -->
                            <input type="file" name="adjunto" accept=".mp4" multiple />
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Subir Video">
                    </form>
                            <div id="login" class="text-right">
                                <a href="main.php" class="text-info">Tornar Home</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>