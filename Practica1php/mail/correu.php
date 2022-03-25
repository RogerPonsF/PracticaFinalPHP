<?php
    use PHPMailer\PHPMailer\PHPMailer;
    include '../vendor/autoload.php'; 


   function enviarmail($infousuariC,$infousuariU,$acode,$cp)
   {
   
    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    
    $mail->Username = 'probacinetics@gmail.com';
    $mail->Password = 'CINETICS2022';
    $mail->SetFrom('contact@cinetics.com','contact');
    $mail->Subject = 'Confirm your mail account';
    
    if($cp==false) 
        $mail->MsgHTML(messageM($infousuariC,$infousuariU,$acode));
    else 
        $mail->MsgHTML(messageP($infousuariC,$infousuariU,$acode));

    $mail->AddAddress($infousuariC,$infousuariU);
    $mail->Send();
   }
            
   function messageM($infousuariC,$infousuariU,$acode)
   {
    $message  = "<html><body>";
    $message .= "<table width='100%' bgcolor='#E0E0E0' cellpadding='0' cellspacing='0' border='0'>";
    $message .= "<tr><td>";
    $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0'>";

    $message .= "<tbody>
        <tr>
        <td colspan='4' style='padding:20px;'>
        <p style='font-size:15px;'>Hola senyor ".$infousuariU."</p>
        <hr />
        <img src='../img/cinetics.jpg' alt='Img' title='Img' style='height:auto; width:100%; max-width:100%;' />
        <a href='http://localhost/Practica1php/mail/comprobarmail.php?code=".$acode."&mail=".$infousuariC."' style='font-size:15px;'>Activa la teva conta bb!</a>
        </td>
        </tr>
        </tbody>";
    $message .= "</table>";
    $message .= "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";
    return $message;
   }
   function messageP($infousuariC,$infousuariU,$acode)
   {
    $message  = "<html><body>";
    $message .= "<table width='100%' bgcolor='#E0E0E0' cellpadding='0' cellspacing='0' border='0'>";
    $message .= "<tr><td>";
    $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0'>";

    $message .= "<tbody>
        <tr>
        <td colspan='4' style='padding:20px;'>
        <p style='font-size:15px;'>Hola senyor ".$infousuariU."</p>
        <hr />
        <img src='./img/cinetics.jpg' alt='Img' title='Img' style='height:auto; width:100%; max-width:100%;' />
        <a href='http://localhost/Practica1php/pass/fgpass.php?code=".$acode."&mail=".$infousuariC."' style='font-size:15px;'>Canviar contrasenya!</a>
        </td>
        </tr>
        </tbody>";
    $message .= "</table>";
    $message .= "</td></tr>";
    $message .= "</table>";
    $message .= "</body></html>";
    return $message;
   }
?>