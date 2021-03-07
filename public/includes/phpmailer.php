<?php

include_once('pass.php');


function send_email($email, $fullname)
{
    $file = 'file.txt';


    require '../PHPMailer/PHPMailerAutoload.php';

    require_once('functions.php');

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(false);

    //echo PHPMailer::ENCRYPTION_STARTTLS;

    try {
        //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->SMTPDebug  = 0;
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = get_username($file);                     //SMTP username
    $mail->Password   = get_password($file);                               //SMTP password
    $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
        $mail->setFrom('no-reply-register-form@gmail.com', 'Shop');
        $mail->addAddress($email);     //Add a recipient
        //$mail->addAddress('ellen@gmail.com');               //Name is optional
        $mail->addReplyTo('info@gmail.com', 'Information');
        /*$mail->addCC('cc@gmail.com');
        $mail->addBCC('bcc@gmail.com');*/

        //Attachments
        /*$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
        $mail->Body    = '<div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> "Message has been sent <strong>"' . $email .'"</strong> " ' . $fullname . '
      </div>';
        $mail->AltBody = '<div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> "Message has been sent <strong>"' . $email .'"</strong> " ' . $fullname . '
      </div>';

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
//send_email('smiljanko@gmail.com');
