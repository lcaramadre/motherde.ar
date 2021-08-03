<?php
  ob_start();
  echo '<center><br><br><br><h3>Enviando los datos...<br><br></h3></center>';
  ob_end_flush();
  ob_flush();
  flush();
  ob_start();
  mb_internal_encoding('UTF-8');

  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  //Load Composer's autoloader
  // require 'vendor/autoload.php';

  require './PHPMailer/src/Exception.php';
  require './PHPMailer/src/PHPMailer.php';
  require './PHPMailer/src/SMTP.php';

if($_POST['contacto']=="1"){

  include './.secret.php';

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer();

  $mensaje="<b>De:</b> <i>".utf8_decode($_POST['nombres'])."</i><br><br><b>mail:</b> ".utf8_decode($_POST['mail'])."<br><br><b>Mensaje:</b> ".utf8_decode($_POST['mensaje']);

  try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = MAIL_USER;                     //SMTP username
      $mail->Password   = MAIL_PASS;                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
      $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
      );
      //Recipients
      $mail->setFrom(MAIL_USER, MAIL_USER_DES);
      $mail->addAddress(MAIL_USER, MAIL_USER_DES);     //Add a recipient
      // $mail->addAddress('ellen@example.com');               //Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = utf8_decode($_POST['asunto']);
      $mail->Body    = $mensaje;
  // 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo '<center><br><br><br><h3>Los datos se enviaron correctamente<br><br>a la brevedad me contactaré con Ud.<br><br>Gracias! </h3></center>';
      // header("Location: ./contacto.html");
      // ob_flush();
      ob_end_flush();
      ob_flush();
      flush();
      ob_start();
      sleep(5);
      print "<script>window.location.href='./contacto.html'</script>";

      // die();
  } catch (Exception $e) {
    echo "<center><br><br><br><h3>Se produjo un error al enviar los datos,<br><br> por favor contacteme al correo lcaramadre@gmail.com</h3></center>";
      // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  ob_end_flush();
}
?>